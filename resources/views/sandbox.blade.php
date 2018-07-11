$resume = Resume::where('user_id', $id)->get();
            if (count($resume) > 0) {
            foreach ($resume as $resume) {
            $file = $resume->resume;
            $filePath = public_path()."/storage/resumes/".$file;
            $fileName = $resume->resume;
            $headers = [
                  'Content-Type' => 'application/msword',
               ];

    return response()->download($filePath, $fileName, $headers);}
            }else{return redirect ('/applications')->with('error','Unable to access Resume');}


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


