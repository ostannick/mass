<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrezController extends Controller
{
    public function records(Request $request)
    {
      $cmd = "python -u ../python/fetch_lbpb.py $request->db $request->search_query $request->retmax";
      while (@ ob_end_flush()); // end all output buffers if any

      $proc = popen($cmd, 'r');
      echo '<pre>';
      while (!feof($proc))
      {
          echo fread($proc, 4096);
          @ flush();
      }
      echo '</pre>';
    }
}
