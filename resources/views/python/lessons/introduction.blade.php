@extends('python.layouts.tutorial')
@section('lesson')
<h2><i class="fal fa-fw fa-code"></i> Python for Graduate Studies - Introduction</h2>
<p>
  If you are entering graduate studies, it is imperative that you understand how to use a programming language.
At some point, you will need to download records from NCBI, process lots of sequences, or plot data programmatically.
Programming is not hard! Rather, online resources are absolutely terrible for explaining the 'nuances' of languages.
</p>
<p>
Also, there aren't many resources online that teach programming from a perspective that biologists or biochemists would
find useful. Here, I want to introduce programming concepts very simply, and create projects that actually <strong>do something useful</strong>
in the context of working in the lab.
</p>
<p>
It is not necessary to have a computer science background in order to perform useful tasks with Python.
You will however have to get comfortable with the following two formatting cues. When you see
a monospace font (all letters are equal width) in a light-grey block, it means I want you to write that code.
You can copy it too, but I recommend writing it -- it will stay in your mind better that way.
</p>
<p>
When you see a dark block with code in it, it means that I ran the code, and the computer spit that information
back out at us.
</p>
<i class="fal fa-fw fa-keyboard"></i> Our <strong><span class="ui teal text">input</span></strong> code (what we write):
<pre>
peptide = "FKCRWLLCKRRKRKCAWAFA"
print(peptide)
</pre>
<i class="fal fa-fw fa-tv"></i> The <strong><span class="ui violet text">output</span></strong> text (what the computer spits out):
<pre class="out">
FKCRWLLCKRRKRKCAWAFAA
</pre>

@endsection
