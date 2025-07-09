<html>
<head>
    <meta charset="UTF-8">
    <title>Accountability Form</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
        .signature-line { border-bottom: 1px solid #000; width: 200px; height: 30px; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Equipment Release Accountability Form</h2>

    <div class="section">
        <p><span class="label">Name:</span> {{ $request->user->name }}</p>
        <p><span class="label">Email:</span> {{ $request->user->email }}</p>
        <p><span class="label">Designation:</span> {{ $request->user->designation }}</p>
        <p><span class="label">Department/Office:</span> {{ $request->user->department }}</p>
        <p><span class="label">Campus:</span> {{ $request->user->campus }}</p>
    </div>

    <div class="section">
        <p><span class="label">Equipment:</span> {{ $request->equipment->name }}</p>
        <p><span class="label">Model:</span> {{ $request->equipment->model }}</p>
        <p><span class="label">Serial Number:</span> {{ $request->equipment->serial_number }}</p>
        <p><span class="label">Purpose:</span> {{ $request->purpose }}</p>
        <p><span class="label">Release Date:</span> {{ $request->release_date }}</p>
    </div>

    <div class="section">
        <p><span class="label">Approved By:</span> ________________________</p>
        <p><span class="label">Date Approved:</span> ______________________</p>
    </div>

    <div class="section">
        <p><span class="label">Signature of Borrower:</span></p>
        <div class="signature-line"></div>
    </div>
</body>
</html>
