<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<tr>
	<td><?php echo esc_html( $label ); ?></td>
	<th><?php echo esc_html( $value ); ?></th>
</tr>