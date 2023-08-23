</div>
<div class="footer">
    <p>Copyright &copy; 2023 <strong>Rizki Febriansah</strong></p>
</div>
</div>

<script type="text/javascript" src="../assets/js/jquery.toastmessage.js"></script>
<script type="text/javascript" src="../assets/js/app.js"></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<script>
    var win = null;

    function NewWindow(myPage, myName, w, h, scroll) {
        LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
        TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
        settings = 'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',resizeable'
        win = window.open(myPage, myName, settings);
    }
</script>
</body>

</html>