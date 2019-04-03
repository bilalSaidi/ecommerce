       <div class="copyright">
			<p class="textCopyright">
			copyright &copy; All Right Reserves  <?php  echo "20" . date('y');  ?> 
			| made with <i class="fa fa-heart" aria-hidden="true"></i> by <span>Bilal Saidi</span>
			</p>
		</div>

		<script src="<?php echo $js ; ?>jquery-2.1.1.min.js"></script>
		<script src="<?php echo $js ; ?>bootstrap.min.js"></script>
		<script src="<?php echo $js ; ?>lightbox.min.js"></script>
		<script src="<?php echo $js ; ?>pluginFrontEnd.js"></script>
		<?php if ($isArabic == true) { ?>
		  <script src="<?php echo $js ; ?>pluginBackEndArabic.js"></script>
		<?php } ?> 

	</body>
</html>