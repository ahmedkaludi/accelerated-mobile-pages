<?php global $redux_builder_amp; ?>
<?php if($redux_builder_amp['enable-amp-ads-2'] == true) : ?>
    <div class="amp-ad-wrapper">
    <amp-ad class="amp-ad-2"
    <?php if($redux_builder_amp['enable-amp-ads-select-2'] == 1) : ?>
      width=300 height=250
    <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 2) :?>
      width=336 height=280
    <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 3) :?>
      width=728 height=90
    <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 4) :?>
      width=300 height=600
    <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 5) :?>
      width=320 height=100
    <?php endif?>
      type="adsense"
      data-ad-client="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-client-2']; ?>"
      data-ad-slot="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-slot-2']; ?>">
    </amp-ad>
    </div>
<?php elseif ($redux_builder_amp['enable-amp-ads-2'] == false) : endif ?>
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