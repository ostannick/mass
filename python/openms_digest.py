from pyopenms import *
from urllib.request import urlretrieve
# from urllib import urlretrieve  # use this code for Python 2.x
urlretrieve ("http://www.uniprot.org/uniprot/P02769.fasta", "bsa.fasta")

dig = ProteaseDigestion()
dig.setEnzyme('Lys-C')
bsa = "".join([l.strip() for l in open("bsa.fasta").readlines()[1:]])
bsa = AASequence.fromString('LKLKLKLKLKLKLKLKLKLKLKLKLKLKLKLKLNNRQQWWPNK')
result = []
dig.digest(bsa, result)
print(result[4].toString())
len(result)
