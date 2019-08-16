import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import re
import seaborn as sns
import sys

sns.set_style('darkgrid')

plt.figure(figsize=(22,17)) #(8.5*2)x(11x2)... aspect ratio preserved for printing, but still zoomable

input_file = sys.argv[1]
jobDir = sys.argv[2]

df = pd.read_excel(input_file)

print(df)

resIds = df['ID']
residues = df['RES']

h_shifts = df['H'].tolist()
n_shifts = df['N'].tolist()
ca_shifts = df['CA'].tolist()
cb_shifts = df['CB'].tolist()
co_shifts = df['C'].tolist()

### -- SET UP HSQC PLOT --- ###
plt.subplot(2, 3, 1)
plt.scatter(h_shifts, n_shifts, alpha=0.5, marker=".")
plt.xlim(10.5, 6.0)
plt.ylim(133, 103)
plt.xlabel('1H (ppm)')
plt.ylabel('15N (ppm)')
plt.title('PROSECCO HSQC')
#Annotate the points
for x in range(0, len(resIds) - 1):
    res = residues[x].strip()
    if(res == 'P'):
        continue
    plt.annotate((residues[x].strip() + str(resIds[x])), xy=(h_shifts[x],n_shifts[x]), size=4)

### -- SET UP ALPHA CARBON PLOT --- ###
plt.subplot(2, 3, 2)
plt.scatter(ca_shifts, n_shifts, alpha=0.5, marker=".")
plt.xlim(70, 43)
plt.ylim(133, 103)
plt.xlabel('13C (ppm)')
plt.ylabel('15N (ppm)')
plt.title('PROSECCO N vs CA')
#Annotate the points
for x in range(0, len(resIds) - 1):
    plt.annotate((residues[x].strip() + str(resIds[x])), xy=(ca_shifts[x],n_shifts[x]), size=4)

### -- SET UP BETA CARBON PLOT --- ###
plt.subplot(2, 3, 3)
plt.scatter(cb_shifts, n_shifts, alpha=0.5, marker=".")
plt.xlim(73, 15)
plt.ylim(133, 103)
plt.xlabel('13C (ppm)')
plt.ylabel('15N (ppm)')
plt.title('PROSECCO N vs CB')
#Annotate the points
for x in range(0, len(resIds) - 1):
    res = residues[x].strip()
    if(res == 'G'):
        continue
    plt.annotate((residues[x].strip() + str(resIds[x])), xy=(cb_shifts[x],n_shifts[x]), size=4)

### -- SET UP CARBONYL PLOT --- ###
plt.subplot(2, 3, 4)
plt.scatter(co_shifts, n_shifts, alpha=0.5, marker=".")
plt.xlim(180, 173)
plt.ylim(133, 103)
plt.xlabel('13C (ppm)')
plt.ylabel('15N (ppm)')
plt.title('PROSECCO N vs CO')
#Annotate the points
for x in range(0, len(resIds) - 1):
    plt.annotate((residues[x].strip() + str(resIds[x])), xy=(co_shifts[x],n_shifts[x]), size=4)

### -- SET UP BETA CARBON VS ALPHA CARBON PLOT --- ###
plt.subplot(2, 3, 5)
plt.scatter(cb_shifts, ca_shifts, alpha=0.5, marker=".")
plt.xlim(75, 15)
plt.ylim(66, 51)
plt.xlabel('13C (ppm)')
plt.ylabel('13C (ppm)')
plt.title('PROSECCO CB vs CA')
#Annotate the points
for x in range(0, len(resIds) - 1):
    res = residues[x].strip()
    if(res == 'G'):
        continue
    plt.annotate((residues[x].strip() + str(resIds[x])), xy=(cb_shifts[x],ca_shifts[x]), size=4)

plt.gcf()

plt.savefig(jobDir + 'PROSECCO_Graphical_Analysis.png', dpi=300)
#plt.show()
