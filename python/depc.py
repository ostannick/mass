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

# -----------------Settings--------------------- #
tolerance = 2.0
instrumentLower = 650.0
instrumentUpper = 4000.0

# Define the variable modifications for DEPC experiment
vm = [
varMod_MethionineOxidation,
varMod_DEPC
]

# Input protein sequence from command line
protein_sequence = sys.argv[1]
protease = sys.argv[2]

# Generate the database
db = peptideDatabase(protein_sequence, protease)
db.generate(iodo=True, variableModifications=vm)
# Trim anything that lies outside detector range
db.trim(instrumentLower, instrumentUpper)
# Sort by mz1
db.sort()
# Identify peptides that fall within each other's tolerance boundary
db.precursorSpectralCrowdingTolerance(tolerance)
# Send to PHP
print(db.serializeDatabase())
