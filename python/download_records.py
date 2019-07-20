from Bio import Entrez
import xml.etree.ElementTree as ET

Entrez.email = "nick.ostan@live.ca"
handle = Entrez.esearch(db="gene", term="BRCA1", retmax="100")
record = Entrez.read(handle)

#Open a new file

#f = open("../storage/app/fasta/fasta.fa", "w")

for id in record["IdList"]:
    protein = Entrez.efetch(db="protein", id=id, rettype="gb", retmode="xml")

    root = ET.fromstring(protein.read())

    sequence = root[0].find("GBSeq_sequence")
    f.write(">" + id + "\n")
    f.write(sequence.text + "\n\n")
    print(sequence)

f.close()
