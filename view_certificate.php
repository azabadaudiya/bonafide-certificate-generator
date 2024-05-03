<?php
// Include the FPDF class and other necessary files
require('fpdf/fpdf.php');
include 'connection.php';
class GECGBonafideCertificate extends FPDF {
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    function Header() {
        // Logo
        $headerWidth = 150; 
        $headerHeight = 50; 
        $x = ($this->GetPageWidth() - $headerWidth) / 2;
        $this->Image('header.png', $x, 10, $headerWidth, $headerHeight);

        $this->Ln(10);
        $this->Ln(10);
        $this->Ln(10);
        $this->Ln(10);
    }

    // Certificate content
    function Certificate($row) {
        $uniqueId = uniqid() . time();
        $this->SetFont('Arial', '', 10);
        $this->Cell(0,30,'No.- GECG/STS/2022/CERTI/',0,0);
        $this->Cell(0, 30, 'Date: ', 0, 0, 'R');
        $this->Image('img_uploads/' . $row['student_image'], 160,70, 40);
        $this->Ln(10);
        $this->SetFont('Arial', 'BU', 12);
        $this->Cell(0, 40, 'BONAFIDE CERTIFICATE', 0, 1, 'C');
        $this->Cell(0, -20, 'To whom so it may concern', 0, 1, 'C');
        $this->Ln(10);
        $this->Ln(10);
        
        // Student details
        $this->SetFont('Arial', '', 12);
        $htmlContent = '<br><p>This is to certify that Mr/Ms <u><b>'.$row['name'].'</u></b> is a bonafide student of our college. He/She is studying in semester <u><b>'.$row['semester'].'</b></u> of <u><b>'.$row['branch'].'</b></u> branch of B.E with Enrollment no <u><b>'.$row['enrollment'].'</b></u>.</p>
        <br><br><p>He bears good moral character. This certificate is issued to him/her for <u><b>'.$row['purpose'].'</b></u> purpose.</p>';
        $this->WriteHTML($htmlContent);
        $this->Ln(10);
        $this->Cell(130, 10, 'Principal', 0, 1, 'R');
        $this->Cell(177, 10, 'Government Engineering College,', 0, 1, 'R');
        $this->Cell(157, 10, 'Sector-28 Gandhinagar', 0, 1, 'R');
        $this->Ln(10);
        $this->Line(10, 175, 200, 175);
        $this->SetFont('Arial', '', 10);
        $this->Ln(10);
        $this->Cell(0,5,'No.- GECG/STS/2022/CERTI/',0,0);
        $this->Cell(0, 5, 'Date: ', 0, 1, 'R');
        $this->Image('img_uploads/' . $row['student_image'], 160, 190, 40);
        $this->Ln(10);
        $this->SetFont('Arial', 'BU', 12);
        $this->Cell(0, 10, 'BONAFIDE CERTIFICATE', 0, 1, 'C');
        $this->SetFont('Arial', '',11);
        $htmlContent = "<p>Office Copy Student's Name: <b>" . $row['name'] . "</b></p><br><br><p>Student's Enrollment No: <b>".$row['enrollment']."</b></p><br><br><p>Department: <b>".$row['branch']."</b></p><br><br><p>Purpose: <b>".$row['purpose']."</b></p><br><br><p>Sign of Student:</p>";
        $this->Image('sign_uploads/' . $row['signature'], 10, 255, 30);
        $this->WriteHTML($htmlContent);
    }
}
// Check if the application ID is provided
if (isset($_GET['application_id'])) {
    $application_id = $_GET['application_id'];

    // Query to fetch the application data
    $query = "SELECT * FROM application WHERE application_id = '$application_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Create a new instance of GECGBonafideCertificate
        
        $pdf = new GECGBonafideCertificate();
        $pdf->AddPage();
        $pdf->Certificate($row);

        // Output the PDF to the browser
        $pdf->Output();
    } else {
        echo "Error fetching application data.";
    }
} else {
    echo "Application ID is not provided.";
}
?>
