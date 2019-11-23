# Import Libraries

import numpy as np
import pandas as pd
import re
import json
import sys
from pyopenms import *
from Bio.SeqUtils import molecular_weight
import operator

# --- Globals --- #
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

# ---------------------------------------------- #
protein_sequence = AASequence.fromString("AEQNGKIAENAETTNKSGVISKSTKPTKDQIEFAKQKLTEKVERLKKDLSDLIATYPNSKDKSALKKQITDKVLAGYVDVKEREYAEDDLKELLNALDVAEERANATEDILNILITGDKYKTDNEDNLKEFLVQSPLVQSTTNHTQEQLAIARDKLKAQLETEKQDLEELLATFVIGNEILGDEDGEEIDAKELDKLKAQIIDKIKNAYTEDKRTEVEKQAKLLIEQLKAEDEETTAKLVEFLAKGDKFDGENMANLTAYLPALVPRGSSAHHHHHHHHHH")

# Create the digest object
dig = ProteaseDigestion()

# Get all enzymes
proteases = []
ProteaseDB().getAllNames(proteases)

# Create coverage array
coverage = []
for protease in proteases:
    dig.setEnzyme(protease)

    peptideList = []
    dig.digest(protein_sequence, peptideList)

    coverage.append([
    DetectorRangeCoverage(peptideList, instrumentLower, instrumentUpper),
    protease.decode("utf-8")
    ])

# For JSON communication
json_dump(sorted(coverage, key=operator.itemgetter(0), reverse=True)
