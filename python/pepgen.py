#Import Libraries
import matplotlib.pyplot as plt
import numpy as np
import re
import json
import sys
from Bio.SeqUtils import molecular_weight

#Parameters

#Peptides with a mass smaller than this value will be excluded from analysis, typically chosen based on instrumentatiton range
filterMassLower = float(sys.argv[1])
filterMassUpper = float(sys.argv[2])
iodoacetamideMassShift = 57.0520
methionineOxidationMassShift = 15.9994
protonMass = 1.0000

#Common contaminants mass array (trypsin, keratin, etc)
commonContaminants = []

#Mass Tolerance of the instrument in daltons/ppm
massTolerance = float(sys.argv[3])

#Values can be integers -1; 0; +1; +2; +3;, etc.
chargeState = float(sys.argv[4])

protSeq = sys.argv[5]
protSeqAALength = len(protSeq)

#Split by trypsin regular expression (negative lookbehind, positive look-ahead on a negative set)
pepArray = re.split('(?<=[RK])(?=[^P])', protSeq)

pepList = []
#Calculate the peptide masses with biopython's molecular_weight function
for peptide in pepArray:

    visibility = False
    if((molecular_weight(peptide, 'protein') >= filterMassLower) & (molecular_weight(peptide, 'protein') <= filterMassUpper)):
        visibility = True

    #add the carbamidomethyl group and one dalton for the protonated state
    fixedModificationShift = len(re.findall('C', peptide)) * iodoacetamideMassShift + (protonMass * chargeState)
    pepList.append({
        'mass': molecular_weight(peptide, 'protein') + fixedModificationShift,
        'sequence': peptide,
        'visibility': visibility,
        'observed': False,
        'fracIon': 0.0,
    })

#import the mass list obtained experimentally
#[0] = mass, [1] = relative intensity, [2] = match found?, [3] = possible contaminant ID
#this is the format the mass list needs to be parsed into
massList = [
    {'mass': 649.7179, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 1021.689, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 1123.709, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 1913.399, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 1925.701, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 1932.825, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2005.400, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2021.058, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2211.327, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2265.045, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2282.866, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2308.994, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2328.861, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 2667.365, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 3335.326, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
    {'mass': 3360.336, 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''},
]

#Match peptides found and mark as true
matchCount = 0
matchSumAA = 0
for peptide in pepList:
    for mass in massList:
        if((mass['mass'] >= (peptide['mass'] - massTolerance)) & (mass['mass'] <= (peptide['mass'] + massTolerance))):
            peptide['observed'] = True;
            mass['hasMatch'] = True;
            matchCount += 1
            matchSumAA += len(peptide['sequence'])

            mass[2] = True
            break

#Label peptides we found experimentally but do not have an in silico match for... as to predict contaminants


output = {
    'sequence': protSeq,
    'peptides': pepList,
    'observablePeptideCount': str(len(pepList)),
    'matchCount': matchCount,
    'coverage': matchSumAA/protSeqAALength*100,
    'massList': massList,
}
output = json.dumps(output)

print(output)
