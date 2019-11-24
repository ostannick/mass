# createDatabase.py
import re
import copy
import json
import operator
from pyopenms import *
from msPeptide import *
from variableModifications import *

def varMod(pepObj, mod=None, aaString=None, massShift=None, name=None):
    # Supply this function with a peptide, the amino acids to be
    # modified, and the mass shift, and this will return an array
    # of masses corresponding to each population. The actual
    # distribution of these masses in the experiment can inform
    # which residues are getting modified (Pascal's Triangle)
    pepList = []

    #For modifications from variableModifications.py
    if mod is not None:
        rexp = mod['targets']
        sites = len(re.findall(rexp, pepObj.sequence()))
        # print('Found ' + str(sites) + ' ' + mod['name'] + ' sites')

        for x in range(1, sites + 1):
            pep = copy.deepcopy(pepObj)
            pep.addCustomMassShift(x * mod['massShift'])
            pep.modificationLog.append(str(x) + ' ' + mod['name'] + ' mods')
            pepList.append(pep)

    #For hard-coded custom modifications
    else:
        rexp = "[" + aaString + "]"
        sites = len(re.findall(rexp, pepObj.sequence()))

        for x in range(1, sites):
            pep = msPeptide(pepObj.sequence())
            pep.addCustomMassShift(x * massShift)
            pep.modificationLog.append(str(x) + ' ' + modName + ' modifications')
            pepList.append(pep)

    # print(pepList)
    return pepList

class peptideDatabase:
    def __init__(self, sequence, enzyme):
        self.sequence = AASequence.fromString(sequence)
        self.enzyme = enzyme
        self.msPeptides = []

        # Create the digest object
        dig = ProteaseDigestion()

        # Set the protease
        dig.setEnzyme(self.enzyme)

        #Perform digestion
        tempList = []
        dig.digest(self.sequence, tempList)

        # Start group counter at 1
        i = 1
        for pep in tempList:
            self.msPeptides.append(msPeptide(pep.toString().decode("utf-8"), group=i))
            i += 1

    def getPeptides(self):
        return self.msPeptides

    def availableEnzymes(self):
        enzymes = []
        ProteaseDB().getAllNames(enzymes)
        return enzymes

    def trim(self, lower, upper):
        toBeDeleted = []
        for x in range(0, len(self.msPeptides)):
            if(self.msPeptides[x].mz1() < lower or self.msPeptides[x].mz1() > upper):
                toBeDeleted.append(x)  # Removes this index from the list

        toBeDeleted.sort(reverse = True)
        for x in toBeDeleted:
            self.msPeptides.pop(x)

    def generate(self, iodo=False, variableModifications=None):
        masterList = []

        if(iodo):
            for pep in self.msPeptides:
                pep.iodoacetamide()
                masterList.append(pep)
        else:
            for pep in self.msPeptides:
                masterList.append(pep)

        for mod in variableModifications:
            tempList = []
            for pep in masterList:
                tempList.extend(varMod(pep, mod))
            masterList.extend(tempList)

        # print("Search space increased by " + str(len(masterList) / len(self.msPeptides)) + "x")
        self.msPeptides = masterList
        return self

    def serializeDatabase(self):
        json_db = []
        for x in range(len(self.msPeptides)):
            json_db.append({
            "id": x,
            "sequence": self.msPeptides[x].sequence(),
            "mz1": self.msPeptides[x].mz1(),
            "length": self.msPeptides[x].len(),
            "group": self.msPeptides[x].group,
            "massShift": self.msPeptides[x].massShift,
            "modifications": json.dumps(self.msPeptides[x].modLog()),
            "toleranceConflicts": self.msPeptides[x].toleranceConflicts,

            })

        return json.dumps(json_db)

    def sort(self):

        self.msPeptides = sorted(self.msPeptides, key=lambda obj: obj.mz1())
        return

    def precursorSpectralCrowdingTolerance(self, tol):

        for x in range(len(self.msPeptides)):
            for y in range(len(self.msPeptides)):
                if(abs(self.msPeptides[x].mz1() - self.msPeptides[y].mz1()) <= tol and x != y):
                    self.msPeptides[x].toleranceConflicts += 1

        return
