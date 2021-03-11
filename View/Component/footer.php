        <script defer>
            <?= "var timeOut = setTimeout(getMessages, 500,$lastId);"?> 
            <?php if($lastId!=0) echo "document.querySelector(`#message$lastId`).scrollIntoView();"?> 
        </script>      
    </body>
</html>