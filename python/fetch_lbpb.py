from Bio import Entrez
import xml.etree.ElementTree as ET
import sys

Entrez.email = "nick.ostan@live.ca"
handle = Entrez.esearch(db=sys.argv[1], term=sys.argv[2], retmax=int(sys.argv[3]))
record = Entrez.read(handle)

print(record["IdList"])

#Open a new file

f = open("Neisseria_meningitidis_Lbpbs.fa", "w")

for id in record["IdList"]:
    protein = Entrez.efetch(db="protein", id=id, rettype="gb", retmode="xml")

    root = ET.fromstring(protein.read())

    sequence = root[0].find("GBSeq_sequence")
    f.write(">" + id + "\n")
    f.write(sequence.text + "\n\n")
    print(">" + id + '\n')
    print(sequence.text + '\n')


f.close()
