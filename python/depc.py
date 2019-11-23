# Import Libraries

import numpy as np
import pandas as pd
import re
import json
import sys
from pyopenms import *
from Bio.SeqUtils import molecular_weight
import operator

# -----------------Globals---------------------- #
depcMassShift = 72.021655 #Isotopic mass abundances from sisweb.com, I removed 1.0073 for the proton that leaves
tolerance = 2.0
instrumentLower = 500.0
instrumentUpper = 4000.0

# ---------------------------------------------- #
# -----------------Functions-------------------- #
# ---------------------------------------------- #

def DetectorRangeCoverage(arr, lower, upper):
    count = 0
    for pep in arr:
        mw = molecular_weight(pep.toString().decode("utf-8"), 'protein')
        if(mw >= lower and mw <= upper):
            count += 1
    return(100*count / len(arr))

def dbTrim(arr, lower, upper):
    db = []
    for entry in arr:
        if(entry[1] <= lower or entry[1] >= upper):
            arr.remove(entry)
        else:
            db.append(entry)

    return db

def CalculateCrowding(peaks, lower, upper):
    return((upper-lower)/peaks)
# ---------------------------------------------- #
protein_sequence = AASequence.fromString("MKYLLPTAAAGLLLLAAQPAMAMAHHHHHHLVPRGSMNFRPKYLPLVITAMLCSSLPAFANNNEDDPSVELETVTIIIKKRLHAKSEEVTGLGKTIKTMDDLNKNQVLSVKDMVKDVAGVAVVEQGRGASSGYTIRGMDKNRVAVNVDGIAQIQSYLTQKRQFGDGREGSGAINEIELENVSGVQISQGASGSETGSGALGGAVSFRTKSIDDVLDADDNFSAFYKGAYASKNKQKMHSVGAALRHKKADLFVQYTDRTKETVKPHSDIYQTNYEVWRWGGSQVDFDKQAIAPTNDPKRQFIIIDECPTYVDKDPSSVAGCTKPKLDIKPVLETMGAKEYTGDKRVLPDPMEYDSKSVLIKAGFNPSSTQRVELLTEKTTQNYNSRDMTKTAYHLAANHGRGNLAQSPLVYRGQSYQEGYVTDAKIGLWTQTQFFDEKHDKSRYGINYRYQSPKDFRWFDELNLSVDKQTVTIDHLQIEKYCSPYPTVDRNCTPSADKPNSAERQNRKVYSEDHLLWRGDFSKNLSGDIINHRLNLGFGLDKFRSNLWIGDIKERYHRLDFKFVDDIKDSNGNFIEAYRINQYQEGTDICQEAQQYLGEARKCGDRPITGHNAYATFKDTISIGDLANITLGVRHDTHRFNSDDDWTGTGKYRNLSYNGSLVLKPTDHVDLLYRISSGYRVPSFKELFGYRLDGLTKGENDDQHYRTNVKPEKARNQEFGIAVHGNLGEVTATYFDNRYSDLIDLTLKGDQWGYRNYQDVHLAGHSVQAKAYLGELWDKLPVGLTASANYLKTKVKDSHIKEGFEYGSGYFLDTISPTRYALSLDYTADSDKWGLGATWIFSDAKKDTELTTLVASPSGTYEKVATTVNSKAWRTLDLSAFYQPTDNLTVRAGIDNVFNYRYSPWESLRQTSVVSGNQHTQGLPSQYAASGRNFVLSVQTKF")

# Create the digest object
dig = ProteaseDigestion()

# Set the protease
protease = 'Chymotrypsin'
dig.setEnzyme(protease)

# Create the in silico digestion array
peptideList = []
dig.digest(protein_sequence, peptideList)

# Create the mass database
db = []
for peptide in peptideList:
    peptide = peptide.toString().decode("utf-8")

    # Count the number of modifiable residues
    potential_modifications = len(re.findall('[HKYST]', peptide))

    # Create variable modification DEPC database
    for mods in range(0, potential_modifications):
        db.append([
        peptide,
        molecular_weight(peptide, 'protein') + (mods * depcMassShift),
        mods
        ])

db = sorted(db, key=operator.itemgetter(1))
db = dbTrim(db, 500.0, 4000.0)
print(db)
print(len(db))
print(CalculateCrowding(len(db), instrumentLower, instrumentUpper))
