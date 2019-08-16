import pandas as pd
import numpy as np
import json

#Make sure to strip the whitespaces from the headers in the excel file...
#I don't know why there are whitespaces there, but there are.
df = pd.read_excel('data/prosecco.xlsx')

print(df)

resIds = df['ID']
residues = df['RES']
resis = []

h_shifts = df['H'].tolist()
n_shifts = df['N'].tolist()
ca_shifts = df['CA'].tolist()
cb_shifts = df['CB'].tolist()
co_shifts = df['C'].tolist()

#Clean those stupid whitespaces up off the residue name list
for resi in residues:
    resis.append(resi.strip())

#Now we loop through the cleaned list
lh_fruit = [] #Create the empty low-hanging fruit list to house our linked resis
for index, resi in enumerate(resis):
    if(resi == 'A' or resi == 'G' or resi == 'T' or resi == 'S' or resi == 'P'):
        if(index == 0 or index == len(resi) - 1):
            continue
        lh_fruit.append(
        {
        'residue': resis[index] + str(resIds[index]),
        'shifts': {
            'resi_im1': {
                'RESI': resis[index - 1] + str(resIds[index - 1]),
                'H': h_shifts[index - 1],
                'N': n_shifts[index - 1],
                'CO': co_shifts[index - 1],
                'CA': ca_shifts[index - 1],
                'CB': cb_shifts[index - 1],
            },
            'resi_i': {
                'RESI': resis[index] + str(resIds[index]),
                'H': h_shifts[index],
                'N': n_shifts[index],
                'CO': co_shifts[index],
                'CA': ca_shifts[index],
                'CB': cb_shifts[index],
            },
            'resi_ip1': {
                'RESI': resis[index + 1] + str(resIds[index + 1]),
                'H': h_shifts[index + 1],
                'N': n_shifts[index + 1],
                'CO': co_shifts[index + 1],
                'CA': ca_shifts[index + 1],
                'CB': cb_shifts[index + 1],
            }
        }

        }

        )

jsObject = json.dumps(lh_fruit)

print(jsObject)
