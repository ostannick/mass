import re
import copy
from Bio.SeqUtils import molecular_weight

class msPeptide:
    def __init__(self, seq):
        self.seq = seq
        self.massShift = 0
        self.modificationLog = []

    def seq(self):
        return str(self.seq)

    def len(self):
        return len(self.seq)

    def mw(self):
        return molecular_weight(self.seq, 'protein')

    def aaCount(self, aa):
        return len(re.findall(aa, self.seq))

    def iodoacetamide(self):
        self.massShift += 57.0520 * len(re.findall('C', self.seq))
        self.modificationLog.append('Carbamidomethyl (C)')
        return self

    def varMethionineOxidation(self):
        potential_modifications = len(re.findall('M', self.seq))
        childPeptides = []
        for mod in range(0, potential_modifications):
            childPep = copy.deepcopy(self)
            childPep.massShift += (mod * 15.9994)
            childPeptides.append(childPep)
        return childPeptides

    def mz1(self):
        return (self.mw() + self.massShift)

pep = msPeptide("MMCAAAWDAWDACWAWCM")

newPeps = pep.varMethionineOxidation()

for pep in newPeps:
    print(pep.mz1())
