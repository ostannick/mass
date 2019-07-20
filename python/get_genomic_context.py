from Bio import Entrez
import xml.etree.ElementTree as ET
import re

#Get genomic context upstream and downstream
def ContextStream(locusRef, distance):
    geneContext = []

    #Determine leading zeros
    num = re.split('_RS(?=\d)', locusRef) #split by RS identifier
    lz = re.search('^0+', num[1]) #determine the value

    #Cast the regex output to an int
    myInt = int(num[1])

    for x in range(1, (distance+1)):
        if lz is not None:
            geneContext.append(num[0] + '_RS' + lz[0] + str(myInt + (5*x)))
            geneContext.append(num[0] + '_RS' + lz[0] + str(myInt + (-5*x)))
        else:
            geneContext.append(num[0] + '_RS' + str(myInt + (5*x)))
            geneContext.append(num[0] + '_RS' + str(myInt + (-5*x)))

    return geneContext

Entrez.email = "nick.ostan@live.ca"
handle = Entrez.esearch(db="gene", term="DUF560", retmax="200")
record = Entrez.read(handle)

print(record["IdList"])

#Open a new file

#f = open("Neisseria_meningitidis_Lbpbs.fa", "w")
duf560_genomic_contexts = []

for id in record["IdList"]:
    protein = Entrez.efetch(db="gene", id=id, rettype="gb", retmode="xml")

    root = ET.fromstring(protein.read())

    #Print this if you need a reminder of the XML structure that gets returned
    #print(ET.tostring(root, encoding='utf8', method='xml'))

    #This is the element tree address for accessing the locus tag of a gene.
    locusTag = root[0][3][0][0].text

    upstreamDownstream = ContextStream(locusTag, 3)
    print(upstreamDownstream)

    for gene in upstreamDownstream:

        handle = Entrez.esearch(db="gene", term=gene, retmax="1")
        record = Entrez.read(handle)

        try:
            protein = Entrez.efetch(db="gene", id=record["IdList"][0], rettype="gb", retmode="xml")

            root = ET.fromstring(protein.read())
            prot = root[0].findall('Entrezgene_prot')

            if len(prot) is 1:
                for child in prot:
                    try:
                        print(prot[0][0][0][0].text)
                    except:
                        pass
        except:
            pass

    #f.write(">" + id + "\n")
    #f.write(sequence.text + "\n\n")

print(duf560_genomic_contexts)
#f.close()
