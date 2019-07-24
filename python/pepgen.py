#Import Libraries
import seaborn as sns
import matplotlib.pyplot as plt
from matplotlib.pyplot import figure
import numpy as np
import pandas as pd
import re
import json
import sys
from Bio.SeqUtils import molecular_weight




#Settings
sns.set(style="darkgrid")

#Arguments/Parameters
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

#Protein sequence
protSeq = sys.argv[5]
protSeqAALength = len(protSeq)

#Job directory
jobDir = sys.argv[7]

#Split by trypsin regular expression (negative lookbehind, positive look-ahead on a negative set)
pepArray = re.split('(?<=[RK])(?=[^P])', protSeq)

pepList = []
#Calculate the peptide masses with biopython's molecular_weight function
possibleObserved = 0
for peptide in pepArray:
    visibility = False
    if((molecular_weight(peptide, 'protein') >= filterMassLower) & (molecular_weight(peptide, 'protein') <= filterMassUpper)):
        visibility = True
        possibleObserved += 1

    #add the carbamidomethyl group and one dalton for the protonated state
    fixedModificationShift = len(re.findall('C', peptide)) * iodoacetamideMassShift + (protonMass * chargeState)
    pepList.append({
        'mass': molecular_weight(peptide, 'protein') + fixedModificationShift,
        'sequence': peptide,
        'visibility': visibility,
        'observed': False,
        'fracIon': 0.0,
        'absIon': 0,
    })

#import the mass list obtained experimentally
df = pd.read_excel(sys.argv[6], 0, skiprows=2)
peaks = df[['m/z', 'Rel. Intens.', 'Intens.']]


#create the massList array
massList = []
for index, row in peaks.iterrows():
    massList.append({'mass': row['m/z'], 'fracIon': row['Rel. Intens.'], 'absIon':row['Intens.'] , 'hasMatch': False, 'contamMatch': False, 'contamSuspect': ''})


#Match peptides found and mark as true
matchCount = 0
matchSumAA = 0

for peptide in pepList:
    for mass in massList:
        if((mass['mass'] >= (peptide['mass'] - massTolerance)) & (mass['mass'] <= (peptide['mass'] + massTolerance))):
            peptide['observed'] = True
            peptide['fracIon'] = mass['fracIon']
            peptide['absIon'] = mass['absIon']
            mass['hasMatch'] = True
            matchCount += 1
            matchSumAA += len(peptide['sequence'])

            mass[2] = True
            break

#Generate suggested tolerance graph
tolRef = np.arange(0, 10, 0.1).tolist()
tolerances = []
for tol in tolRef:
    currentMatches = 0;
    for peptide in pepList:
        for mass in massList:
            if((mass['mass'] >= (peptide['mass'] - tol)) & (mass['mass'] <= (peptide['mass'] + tol))):
                currentMatches += 1
    tolerances.append(currentMatches / len(pepList))


tol_series_x = tolRef
tol_series_y = tolerances

plt.scatter(tol_series_x, tol_series_y, alpha=0.5)
plt.title('Tolerance Samples')
plt.xlabel('Mass Tolerance')
plt.ylabel('Ion Coverage')
plt.title('Mass Tolerance Sampling')
fig = plt.gcf()
fig.set_size_inches(10, 10)
plt.savefig(jobDir + 'tolerances.png', dpi=150, bbox_inches = 'tight', pad_inches = 0)

stem_series_x = df['m/z'].tolist()
stem_series_y = []
for peak in massList:
    if peak['hasMatch'] is False:
        stem_series_y.append(peak['fracIon'] * -1)
    else:
        stem_series_y.append(peak['fracIon'])


markerline, stemlines, baseline = plt.stem(stem_series_x, stem_series_y, linefmt='grey', markerfmt='kx', use_line_collection=True)
plt.setp(stemlines, 'linewidth', 1)
plt.xlabel('m/z')
plt.ylabel('Relative Intensity')
plt.ylim(-1.1, 1.1)
plt.xlim(filterMassLower, filterMassUpper)
plt.title('Observed Ions (pos = match)')
plt.savefig(jobDir + 'stems.png', dpi=150, bbox_inches = 'tight', pad_inches = 0)

#Label peptides we found experimentally but do not have an in silico match for... as to predict contaminants
output = {
    'sequence': protSeq,
    'peptides': pepList,
    'observablePeptideCount': str(len(pepList)),
    'possibleObserved': possibleObserved,
    'matchCount': matchCount,
    'coverage': matchSumAA/protSeqAALength*100,
    'massList': massList,
    'tolerances': tolerances,
}
output = json.dumps(output)

print(output)
