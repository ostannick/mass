@extends('layouts.app')

@section('content')
<h1><i class="fal fa-fw fa-bacon"></i> Crystallography Course - Construct Design</h1>
<h5>Nicholas K. H. Ostan</h5>
<hr>

<h4>Preamble</h4>
<p>
  I should start by saying that protein for your crystallography experiment doesn't necessarily need to be cloned and expressed in a model organism. You can just as well purify the protein of interest from your organism of interest, though the requirement for large quantities of protein could make this difficult. If you do not have access to enough material/tissue through ethical means, and your purification protocol is difficult, getting enough protein to set up a single crystallization tray could be very difficult. The ability to tag a protein with an affinity tag such as a <a href="https://en.wikipedia.org/wiki/Polyhistidine-tag">polyhistidine tag</a> or <a href="https://en.wikipedia.org/wiki/Glutathione_S-transferase">GST</a> through DNA cloning methods can alleviate a lot of this pain. Additionally, placing the coding sequence for your protein into a plasmid that is downstream of a high-expression promoter (<a href="https://en.wikipedia.org/wiki/T7_RNA_polymerase#Activity">T7</a>) allows you to achieve lots of protein in either a folded or insoluble-unfolded form. Access to large quantities of your protein of interest is a good first step in determining its structure.
</p>

<p>
  If you do choose to clone your protein of interest into an expression vector that has an affinity purifican tag, or a solubility tag, it is recommended that you also engineer in a cleavage site for a specific protease such as <a href="https://en.wikipedia.org/wiki/TEV_protease">Tobacco Etch Virus (TEV) protease</a>, or <a href="https://en.wikipedia.org/wiki/Thrombin">thrombin</a>. We do not want 'floppy' tags interfering with the crystallization process. We also do not want the possibility of tags altering the local or global conformation of our protein, resulting in a misleading structure.
</p>

<p>You should also note that overexpression of a protein in a model organism can sometimes result in misfolding. Additionally, if the model organism is incapable of adding the necessary post-translational modifications to the protein on appropriate sites (i.e. glycosylation, SUMOylation, phosphorylation, etc.), then you may end up solving the structure of a protein with no function. For this reason, it is important to always test that your protein is functional before you crystallize it. Who cares about the structure of a useless protein?</p>

<p>
I have done most of my research in microbiology labs, so I will use a bacterial protein as an example target for this walk-through. We will be trying to crystallize a transferrin-binding protein from <i>Neisseria lactamica</i>. The DNA sequence that encodes this protein can be seen <a href="https://www.ncbi.nlm.nih.gov/nuccore/AM849587.1">here</a>, and below. This this is an outer-membrane receptor protein that enhances the hijacking of iron from human transferrin. In other words, this protein acts as a hand that grabs onto human iron-binding proteins, and helps steal the iron for its own growth.
</p>

<h4>DNA Sequence</h4>
<pre>
TGTCTGGGCGGAGGCGGCGGCAGTTTCGATCTTGATTCTGTCGATACCGAAGCCCCGCGTCCCGCGCCAAAGTATCAAGATGTTTCTTCCGAAAAACCGCAAGCCCAAAAAGACCAAGGCGGATACGGTTTTGCAATGCGCTTCAAGCGGCGGAATTGGCATTCGCAGGCAAATCCTAAAGAAGATGAGATAAAACTTTCTGAAAATGATTGGGAGGCGACAGGATTGCCAGGCAATCCCAAAAACTTACCTGAGCGACAGAAATCGGTTATTGATAAAGTAGAAACAGGCAGCGACAGCAATATTTATTCTTCCCCCTATCTCACGCAATCAAACCATCAAAACGGCAGTGCAAACCAACCAAAAAATGAAGTAAAAGATTATAAAGAGTTCAAATATGTTTATTCCGGTTGGTTTTACAAACACGCTAAACTCGAAATCATAAAAGAAAACAACTTAATTAAGGGTGCAAAGAGCGGCGACGACGGTTATATCTTTTATCACGGTGAAAAACCTTCCCGACAACTTCCCGTTTCTGGAGAAGTTACCTACAAAGGCGTATGGCATTTTGTAACCGATACGAAACAGGACAAAAATTTAACGATATTCTTGGAACCTCAAAAAAAACAAGGCGACAGGTATAGCGGATTTCCGGGTGATGACGGTGAGGAATATTCCAATAAAAATGAAACGACTTTACAAGGCAGTCAAGAGGGTTATGGTTTTACCTCAAATTTAAAAGTGGATTTCAATAAGAAAAAATTGACGGGTGAATTGATACGCAATAATAGAGTTACAAACGCTACTGCTAACGATAAATACACCACCCAATATTACAGCCTTGAGGCTCAAGTAACAGGCAACCGCTTCAACGGCAAGGCAACGGCAACCGACAAACCAAAAGAGAATGGAACCAAACAACATCCCTTTGTTTCCGACTCGTCTTCTTTGAGCGGCGGCTTTTTCGGCCCGAAGGGTGAGGAATTGGGTTTCCGCTTTTTGAGCGACGATAAAAAAGTTGCGGTTGTCGGCAGCGCGAAAACCAAAGACAACACCGCAAATGGCAATACTGCGGCGGCTCCAGGCGGCACAGGTGCGGCAGCATCAAACAGTGCGGCAGGCACGTCGTCTGAAAACAGTAAGCTGACCACGGTTTTGGATGCGGTCGAGCTGACGCACGGCGGCACAGCAATCAAAAATCTCGACAACTTCAGCAACGCCGCCCAACTGGTTGTCGACGGCATTATGATTCCGCTCCTGCCCAAGGATTCCGAAAGCGGGAACAATCAAGCCAATCAAGGTACAAACGGCGGAACAGCCTTTACCCGCAAATTTGACCACACGCCGAAAAGCGATGAAAAAGACACCCAAGCAGGTACGGCGGCGAATGGCAATCAAGCCGCTTCAAATACGGCAGGTGATGCCAATGGCAAAACAAAAACCTATGCAGTCGAAGTCTGCTGTTCCAACCTCAATTATCTGAAATACGGGTTGCTGACGCGCAAAACTGCCGGCAATACGGGGGAAGGCGGCAACGGCAGCCCAACCGCCGCCCAAACGGCACAGGGCGCACAAAGTATGTTCCTCCAAGGCGAGCGCACCGATGAAAAAGAGATTCCAAAAGAGCAACAAAACATCGTTTATCGGGGGTCTTGGTACGGGCATATTGCCAACGGCACAAGCACAAGCTGGAGCGGCAATGCTTCAGATAAAGAGGGAGGCAACAGGGCGGACTTTACCGTGAATTTTGGCGAGAAAAAAATTAACGGCACGTTAACCGCTGAAAACAGGCAGCAGGCAACCTTTACCATTGAGGGAATGATTCAGGGCAACGGTTTTTCCGGTACGGCAAAAACTGCTGACTCAGGCTTTGATCTCGATCAAAGCAATACCACCGGCACGCCTAAGGCATATATCACAAACGCCAAGGTGCAGGGCGGTTTTTACGGGCCTAAAGCCGAAGAAATGGGTGGATGGTTTGCTTATCCGGGCGATAATCAGGCGCAGCCGTCCGCTTCGGGGTCAGGCGCATCAGCCGCCAACAGCGCGACCGTGGTATTCGGTGCGAAACGCCAACAGCCTGTGCAATAA
</pre>

<h4>Protein Sequence Predictions</h4>
<pre class="out">
CLGGGGGSFDLDSVDTEAPRPAPKYQDVSSEKPQAQKDQGGYGFAMRFKRRNWHSQANPKEDEIKLSENDWEATGLPGNPKNLPERQKSVIDKVETGSDSNIYSSPYLTQSNHQNGSANQPKNEVKDYKEFKYVYSGWFYKHAKLEIIKENNLIKGAKSGDDGYIFYHGEKPSRQLPVSGEVTYKGVWHFVTDTKQDKNLTIFLEPQKKQGDRYSGFPGDDGEEYSNKNETTLQGSQEGYGFTSNLKVDFNKKKLTGELIRNNRVTNATANDKYTTQYYSLEAQVTGNRFNGKATATDKPKENGTKQHPFVSDSSSLSGGFFGPKGEELGFRFLSDDKKVAVVGSAKTKDNTANGNTAAAPGGTGAAASNSAAGTSSENSKLTTVLDAVELTHGGTAIKNLDNFSNAAQLVVDGIMIPLLPKDSESGNNQANQGTNGGTAFTRKFDHTPKSDEKDTQAGTAANGNQAASNTAGDANGKTKTYAVEVCCSNLNYLKYGLLTRKTAGNTGEGGNGSPTAAQTAQGAQSMFLQGERTDEKEIPKEQQNIVYRGSWYGHIANGTSTSWSGNASDKEGGNRADFTVNFGEKKINGTLTAENRQQATFTIEGMIQGNGFSGTAKTADSGFDLDQSNTTGTPKAYITNAKVQGGFYGPKAEEMGGWFAYPGDNQAQPSASGSGASAANSATVVFGAKRQQPVQ-
</pre>

<p>You may notice that the protein sequence does not start with a methionine. This is because I am using a 'mature' construct for this protein. Since this protein gets post-translationally processed (it has its N-terminus cleaved and modified), I am excluding the part that is cleaved after translation. It is not necessary for our purposes to include this part of the sequence since it is not present in the final folded protein. Of course, the decision to include or not include certain residues must be made on a per-protein basis, as for other proteins the signal peptides may be important for folding, processing, subcellular localization, etc.</p>

<p>
There are many online servers that take a protein sequence as input and predict various properties of the protein such as propensities of certain stretches of amino acids to be alpha-helical, beta-sheets, or simply random-coil/disordered. <a target="_blank" href="http://xtalpred.godziklab.org/XtalPred-cgi/xtal.pl">Xtalpred</a> is one such server that will submit your sequence to several other servers and then compile the results for you into a single page. Submission of the above sequence to Xtalpred yields the following result:
</p>

<table class="ui selectable table">
  <thead>
    <tr>
      <th>Target</th>
      <th>EP-Class</th>
      <th>RF-Class</th>
      <th>Length</th>
      <th>Mass</th>
      <th>pI</th>
      <th>% Disorder</th>
      <th>% Coil</th>
      <th>% Strand</th>
      <th>% Helix</th>
      <th>Surface Entropy</th>
      <th># Methionines</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-tooltip="The name of our protein" data-variation="mini">TbpB</td>
      <td data-tooltip="Likelihood of this protein to crystallize. 5 = lowest chance" data-variation="mini">5</td>
      <td data-tooltip="Machine learning prediction. 11 = lowest chance" data-variation="mini">11</td>
      <td data-tooltip="Amino acids in our protein" data-variation="mini">696 AA</td>
      <td data-tooltip="Molecular weight of our protein" data-variation="mini">74566 Da</td>
      <td data-tooltip="Isoelectric point. The pH at which net charge = 0" data-variation="mini">6.59</td>
      <td data-tooltip="Percentage of residues in predicted disordered regions" data-variation="mini">19</td>
      <td data-tooltip="Percentage of residues in random coil secondary structure" data-variation="mini">57</td>
      <td data-tooltip="Percentage of residues in strand secondary structure" data-variation="mini">41</td>
      <td data-tooltip="Percentage of residues in helix secondary structure" data-variation="mini">2</td>
      <td data-tooltip="Protein surface conformational entropy score. Low = better" data-variation="mini">-1.19</td>
      <td data-tooltip="Number of methionines. Important for anomalous phasing." data-variation="mini">5</td>
    </tr>
  </tbody>
</table>

<div class="ui segment">
  <img src="{{asset('img/xtalcourse/xtalpred_sequence.jpg')}}" class="ui fluid image">
</div>

<div class="ui segment monospace">
  <span class="ui text">LOOP</a><br/>
  <span class="ui text"><u>DISORDERED</u></a><br/>
  <span class="ui blue text">BETA SHEETS</a><br/>
  <span class="ui red text">ALPHA HELICES</a>
</div>

<p>
We find that the protein has a long stretch of amino acids that are likely to exhibit a disordered configuration in solution. This is undesireable in crystallography because when proteins form crystals, they need to all contact each other in an identical way in order to propagate the crystal lattice. We cannot form crystals if the protein is rapidly undergoing many major conformation changes. As such, it is customary to remove these disordered regions. This can be done several ways - one that we have already seen involved predicting the disordered regions on the computer, and then cloning only the region of the protein that will not be putatively disordered. If you do not trust predictions (as I do not, many times), you can opt to perform <i>in situ</i> proteolysis, or limited proteolysis, as a way of defining domain boundaries.
</p>

<h4>Protein Modelling</h4>
<p>If a structure exists in the <a href="https://www.rcsb.org/">RCSB Protein Databank</a> that shares a high level of sequence similarity with your target protein, it can be useful to generate a <a href="https://en.wikipedia.org/wiki/Homology_modeling">homology</a> or <a href="https://en.wikipedia.org/wiki/Threading_(protein_sequence)">threaded</a> protein model to compare against the other prediction algorithms. This also allows you to visualize the protein's domain(s) and their connectivity more readily. The following image was generated by submission of the primary protein sequence to <a href="https://swissmodel.expasy.org/">SWISS-MODEL</a>.
</p>

<div class="ui segment">
  <img class="ui medium centered image" src="{{asset('img/xtalcourse/model01.png')}}">
</div>

<p>
The protein is coloured with a chainbow colouring method. We can see that the further N-terminal residue SWISS-MODEL was able to model begins at <span class="monospace">QGGY...</span>. Looking back at our sequence, this corresponds to residue 40. Thus, we may make the assumption that amino acids up to residue 40 are likely to be disordered and we can consider creating a construct with those amino acids removed. In the case of TbpB, this makes sense because these proteins are anchored to the outer membrane with long flexible linkers to allow them to extend far from the surface of the cell and capture ligands. Not to say that these amino acids are not functionally important for the protein somehow -- as they may be -- but they may cause issues downstream in crystallography experiments, so we truncate them. Since we do not know at this point how such a truncation may affect folding or function of our protein, it is often useful to create several constructs at the same time, truncating perhaps every 15 amino acids. It is possible that only one or two of 10 constructs will express well in our expression system -- but since cloning and protein expression screens can be done cheaply and in high throughput, it doesn't hurt to try a shotgun approach early on.
</p>

<h4>Limited Proteolysis</h4>
<p>
Another way of defining domain boundaries using actual experimental data is to carry out limited proteolysis. If you mix your protein with a very dilute protease, the protease will cleave the most accessible regions (usually disordered, flexible regions) with the greatest rate. Buried residues are will take much longer to undergo a conformational change that will expose them to a protease's active site. Thus, by tuning the concentration of protease and the duration of the digest, you can digest up only flexible regions of your protein. For example, If you carry out limited proteolysis on a 55kDa protein, assay the resulting fragment(s) by SDS-PAGE and find that your protein has shifted to 50kDa, you know that 5kDa was clipped from the N or C terminus. In-gel digestion followed by tandem mass spectrometry can reveal the exact site at which the protein was cleaved, and give you a great idea of the construct to design as to minimize/remove disordered regions in your protein.
</p>

<div class="ui two buttons">

  <a href="/xtalcourse" class="ui button teal">
    <i class="fal fa-fw fa-arrow-left"></i>
    Previous Section: Introduction
  </a>

  <a href="/xtalcourse/purification" class="ui button purple">
    Next Section: Purification
    <i class="fal fa-fw fa-arrow-right"></i>
  </a>

</div>

<h4>Test Your Understanding:</h4>


<h4>Bibliography & Further Reading</h4>
<div class="ui list">

  <div class="item">
    <i class="fal fa-fw fa-book-open"></i>
  </div>

  <div class="item">
    <i class="fal fa-fw fa-newspaper"></i>
  </div>

</div>

@endsection

<script src="https://www.desmos.com/api/v1.4/calculator.js?apiKey=dcb31709b452b1cf9dc26972add0fda6"></script>
