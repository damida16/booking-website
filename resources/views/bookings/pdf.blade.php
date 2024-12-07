<html>

<head>
    <title>Loan Acknowledgement Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 100px;
            width: auto;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            margin: 0;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info p {
            margin: 0;
        }

        .table-bordered {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .signature-section {
            margin-top: 20px;
        }

        .signature-section p {
            margin: 0;
        }

        .terms {
            margin-top: 20px;
        }

        .terms p {
            margin: 0;
        }

        .highlight {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="width: 100%">
            <tr>
                <td style="width:70%">
                    <img alt="Company Logo" height="100" src="{{ public_path('images/logo-long.png') }}" />
                    <h2>SANGFOR TECHNOLOGIES INDONESIA</h2>
                    <p>
                        Atrium Mulia, 3
                        <sup> rd </sup>
                        floor
                        <br>
                        Jl. HR Rasuna Said Kav 10-11
                        <br>
                        Jakarta, Indonesia 12910
                        <br>
                        Phone :
                        <a href="tel:+622129669283"> +62 21 29669283 </a>
                    </p>
                </td>
                <td style="text-align: right; width:30%">
                    <div style="margin-bottom:8px; text-align: right; margin-left:auto">
                        {!! DNS1D::getBarcodeHTML($booking->booking_code, 'C128', 2, 60) !!}
                    </div>
                    <p>Date: {{ $booking->created_at->translatedFormat('j M y') }}</p>
                </td>
            </tr>
        </table>
        {{-- <div class="header">
            <img alt="Company Logo" height="100" src="{{ public_path('images/logo-long.png') }}" />
            <h1>SANGFOR TECHNOLOGIES INDONESIA</h1>
            <p>
                Atrium Mulia, 3
                <sup> rd </sup>
                floor
            </p>
            <p>Jl. HR Rasuna Said Kav 10-11</p>
            <p>Jakarta, Indonesia 12910</p>
            <p>
                Phone :
                <a href="tel:+622129669283"> +62 21 29669283 </a>
            </p>
        </div> --}}
        {{-- <div class="contact-info">
            <p>Date: {{ $booking->created_at->translatedFormat('j M y') }}</p>
        </div> --}}
        <table class="table-bordered">
            <tr>
                <td style="width: 50%">
                    <strong> FROM: </strong>
                    <br />
                    <strong> PT. SANGFOR TECHNOLOGIES INDONESIA </strong>
                    <br />
                    Atrium Mulia, 3
                    <sup> rd </sup>
                    floor
                    <br />
                    Jl. HR Rasuna Said Kav 10-11
                </td>
                <td style="width: 50%">
                    <strong> TO:
                        <br>
                        {{ $booking->customer }}
                    </strong>
                </td>
            </tr>
        </table>
        <table class="table-bordered">
            <tr>
                <th>ITEM</th>
                <th>MODEL</th>
                <th>SERIAL NO.</th>
                <th>Description</th>
                <th>FROM</th>
                <th>TO</th>
            </tr>
            @foreach ($booking->products as $product)
                <tr>
                    <td>1 SET</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->serial_number }}</td>
                    <td>POC</td>
                    <td>{{ $booking->start_book->translatedFormat('j M y') }}</td>
                    <td>{{ $booking->end_book->translatedFormat('j M y') }}</td>
                </tr>
            @endforeach
        </table>
        <div class="signature-section">
            <p>Notes: {{ $booking->notes }}</p>
            <p>Reason:</p>
            <p>Remark:</p>
        </div>
        <div class="signature-section">
            <p>
                <strong> TO BE SIGNED &amp; STAMPED </strong>
            </p>
            <p>
                <strong> LOAN Acknowledgement: </strong>
            </p>
            <table class="table-bordered">
                <tr>
                    <td style="width: 50%">
                        <p>Loan By:</p>
                        <p>Signature:</p>
                        <p><br><br><br><br></p>
                        <p>Date:</p>
                        <p>Company Stamp: sangfor technologies</p>
                    </td>
                    <td style="width: 50%">
                        <p>Receive By:</p>
                        <p>Signature:</p>
                        <p><br><br><br></p>
                        <p>( Partner/customer please sign here )</p>
                        <p>Date:</p>
                        <p>Company Stamp:</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="signature-section">
            <p>
                <strong> RETURN Acknowledgement: </strong>
            </p>
            <table class="table-bordered">
                <tr>
                    <td style="width: 50%">
                        <p>Return By:</p>
                        <p>Signature:</p>
                        <p><br><br><br></p>
                        <p>( partner/customer please sign here )</p>
                        <p>Date:</p>
                        <p>Company Stamp:</p>
                    </td>
                    <td style="width: 50%">
                        <p>Receive By:</p>
                        <p>Signature:</p>
                        <p><br><br><br><br></p>
                        <p>Date:</p>
                        <p>Company Stamp:</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="terms">
            <p>
                <strong> TERM &amp; CONDITIONS: </strong>
            </p>
            <p>
                a. First time period lending
                <span class="highlight"> 30days </span>
                ( waktu periode peminjaman pertama adalah 30 hari )
            </p>
            <p>b. Please put period leading start to finish.</p>
            <p>
                c. Extension loan form need to be signed if more than standard lending
                period 30days, put the reason for extend in
                <span class="highlight"> remark </span>
                ( untuk perpanjangan peminjaman harus melampirkan/mengirimkan
                Extension Loan Form ke sangfor, lama peminjaman untuk perpanjang
                <span class="highlight"> 30 hari </span>
                disertai alasan untuk perpanjang )
            </p>
            <p>
                d. Submission of extension request not later than
                <span class="highlight"> 1 week from the lending expiry date </span>
                . Otherwise sangfor can't support for demo unit. ( Pengajuan
                permohonan perpanjangan selambat-lambatnya
                <span class="highlight"> 1 minggu </span>
                dari tanggal berakhirnya pinjaman. Jika tidak sangfor tidak dapat
                mendukung untuk peminjaman demo unit. )
            </p>
        </div>
    </div>
</body>

</html>
