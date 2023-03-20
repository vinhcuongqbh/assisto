<form action="/test-controller" method="post" enctype="multipart/form-data">

    <input type="text" name="name" id="name">
    <button id="report" type="submit" onclick="disableReport()">Tạo</button>
</form>


<script>
    function disableReport() {
        //document.getElementById("name").value = "Cường";
        report.disabled = true;
    }
</script>