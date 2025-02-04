<?php if($this->isDebug()): ?>
    <br />
    <hr />
    <?php $this->getRouteLog() ?>
    <hr />
    <?php $this->getDbLogs() ?>
    <hr />
    <br />
<?php endif; ?>
</body>
</html>