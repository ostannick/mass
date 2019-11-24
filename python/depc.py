# Import Libraries

import numpy as np
import pandas as pd
import re
import json
import sys
from pyopenms import *
from Bio.SeqUtils import molecular_weight
import operator
from msPeptide import *
from createDatabase import *
from variableModifications import *

# -----------------Globals---------------------- #
depcMassShift = 72.021655 #Isotopic mass abundances (average mass) from sisweb.com, I removed 1.0073 for the proton that leaves
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

def CalculateCrowding(peaks, lower, upper):
    return((upper-lower)/peaks)
# ---------------------------------------------- #

# Define the variable modifications for DEPC experiment
vm = [
varMod_MethionineOxidation,
varMod_DEPC
]

# Input protein sequence from command line
protein_sequence = sys.argv[1]

#Generate the database
db = peptideDatabase(protein_sequence, "Chymotrypsin")
db.generate(iodo=True, variableModifications=vm)
db.trim(600, 4000)
db.sort()
db.precursorSpectralCrowdingTolerance(2.0)
print(db.serializeDatabase())
