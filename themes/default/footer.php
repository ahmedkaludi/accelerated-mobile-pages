<?php global $redux_builder_amp; ?>
</main>

    <footer class="container">
        <div id="footer">
            <p><a href="#header">Top</a> | <a href="?noamp">View Desktop Version</a></p>
            <p>Copyright &copy; <?php echo date("Y"); ?> </p>
        </div>
    </footer>
    <?php //wp_footer(); ?>

<amp-analytics type="googleanalytics" id="analytics1">
<script type="application/json">
{
  "vars": {
    "account": "<?php echo $redux_builder_amp['ga-feild']; ?>" 
  },
  "triggers": {
    "trackPageview": { 
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>

	</body>
</html>