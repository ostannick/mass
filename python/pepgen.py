#Import Libraries
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
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
df = pd.read_excel(sys.argv[6], 0, skiprows=2)
peaks = df[['m/z', 'Rel. Intens.']]


#create the massList array
massList = []
for index, row in peaks.iterrows():
    massList.append({'mass': row['m/z'], 'fracIon': row['Rel. Intens.'], 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''})


#Match peptides found and mark as true
matchCount = 0
matchSumAA = 0
for peptide in pepList:
    for mass in massList:
        if((mass['mass'] >= (peptide['mass'] - massTolerance)) & (mass['mass'] <= (peptide['mass'] + massTolerance))):
            peptide['observed'] = True
            peptide['fracIon'] = mass['fracIon']
            mass['hasMatch'] = True
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

#print(output)
