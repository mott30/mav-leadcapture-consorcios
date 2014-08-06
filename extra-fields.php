<?php
// Include the meta box script
include( plugin_dir_path( __FILE__ ) . 'meta-box/meta-box.php');

// This file shows a demo for register meta boxes for ALL custom post types

add_action( 'admin_init', 'consorcio_meta_boxes' );

function consorcio_meta_boxes()
{
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	$prefix     = 'consorcio_';
	$meta_boxes = array();

	$post_types = get_post_types();

	// 1st meta box
	$meta_boxes[] = array(
		'id'    => 'credito',
		'title' => __( 'Crédito', 'rwmb' ),
		'pages' => $post_types,

		'fields' => array(
		    // TEXT
			array(
				'name'		=> 'Crédito',
				'id'		=> $prefix . 'credito',
				'type'		=> 'text'
			),			
		)
	);


		$prazos 				=  rwmb_meta( $prefix ."prazos_qtd_max" , '', @$_GET['post']);
		$prazoReduzido 			=  rwmb_meta( $prefix ."_exibirPrazoReduzido" , '', @$_GET['post']);
		$taxasParcelaIntergral 	=  rwmb_meta( $prefix .'_TaxasParcelaIntegralDefault' , '', @$_GET['post']);

		// Campos de cada Prazo
		$prazosFields = array(
							array(
								'name' => 'Meses',
								'id'   => $prefix . 'prazo_'.$i .'_meses',
								'type' => 'number',

								'min'  => 0,
								'step' => 1,
							),             
							array(
								'name' => 'Meia Parcela <strong>R$</strong>',
								'id'   => $prefix . 'prazo_'.$i .'_meiaParcela',
								'type' => 'text',
							),
							array(
								'name' => 'Parcela Integral <strong>R$</strong>',
								'id'   => $prefix . 'prazo_'.$i .'_parcela',
								'class' => $prefix . 'money_field',
								'type' => 'text',
								'std'	=> $post->ID, //TESTE
								'placeholder' => $post->ID,
							),
						);
		var_dump($taxasParcelaIntergral);


		if($prazoReduzido == '1'){
			// Campos adicionais
			// Prazo reduzido
			$prazoReduzidoFields = array(
					array(
						'type' => 'divider',
						'id'   => 'fake_divider_id', // Not used, but needed
						'cllass' => 'prazoReduzido',
					),
					array(
						'type' => 'heading',
						'name' => 'Prazo reduzido',
						'id'   => 'fake_id', // Not used but needed for plugin
						'cllass' => 'prazoReduzido',
					),
					array(
						'name' => 'Meses',
						'id'   => $prefix . 'prazo_'.$i .'_reduzido_'.'_meses',
						'type' => 'number',

						'min'  => 0,
						'step' => 1,
						'cllass' => 'prazoReduzido',
					),  
					array(
						'name' => 'Meia Parcela',
						'id'   => $prefix . 'prazo_'.$i .'_reduzido_'.'_meiaParcela',
						'type' => 'text',
						'cllass' => 'prazoReduzido',
					),           
					array(
						'name' => 'Parcela Integral',
						'id'   => $prefix . 'prazo_'.$i .'_reduzido_'.'_parcela',
						'type' => 'text',
						'cllass' => 'prazoReduzido',
					),
				);
			//Mescla as arrays
			$prazosFields = array_merge($prazosFields, $prazoReduzidoFields);
		};

		// Loop para criar os Meta-Boxes de cada prazo
		for ($i=1; $i <= $prazos; $i++) { 
		 	$meta_boxes[] = array(
				'id'    => 'prazo_'.$i,
				'title' => 'Prazo '.$i,
				'pages' => $post_types,
				'fields' => $prazosFields,
				'validation' => array(
									'rules' => array(
										$prefix . 'prazo_'.$i .'_meses' => array(
																				'required'  => true,
																			),
										$prefix . 'prazo_'.$i .'_parcela' => array(
																				'required'  => true,
																				'minlength' => 3,
																			),
									),
									// optional override of default jquery.validate messages
									'messages' => array(
										$prefix . 'prazo_'.$i .'_meses' => array(
																				'required'  => 'Campo obrigatório',
																			),
										$prefix . 'prazo_'.$i .'_parcela' => array(
																				'required'  => 'Campo obrigatório',
																				'minlength' => 'Digite pelo menos 3 números' 
																			),
									),
								)
			);
		 } ; // End Foreach

		// OPÇÕES
	    // Opções para os meta boxes PRAZOS
		$meta_boxes[] = array(
			'id'    => $prefix . '_options',
			'title' => 'Opções do consórcio',
			'pages' => $post_types,

			'fields' => array(
			    // TEXT
				array(
					'name'	=> 'Total de prazos',
					'id'	=> $prefix . 'prazos_qtd_max',
					'type' 	=> 'number',
					'min'  	=> 1,
					'step' 	=> 1,
				),
				// CHECKBOX
				array(
					'name' => 'Exibir prazo reduzido',					
					'id'   => $prefix ."_exibirPrazoReduzido",
					'type' => 'checkbox',
					// Value can be 0 or 1
					'std'  => 0,
				),
				// DIVIDER
				array(
					'type' => 'divider',
					'id'   => 'fake_divider_id', // Not used, but needed
				),
				array(
						'type' => 'heading',
						'name' => 'Taxas',
						'id'   => 'fake_id', // Not used but needed for plugin
					),
				// CHECKBOX LIST
				array(
					'name' => "Exibir taxas",
					'id'   => $prefix .'_ExibirTaxasParcelaIntegral',
					'type' => 'checkbox_list',
					// Options of checkboxes, in format 'value' => 'Label'
					'options' => array(
						$prefix .'_TaxasParcelaIntegralDefault' => 'Parcela Integral',
						$prefix .'_TaxasMeiaParcelaDefault'     => 'Meia Parcela',
					),
				),
				
				array(
					'name' => 'Taxas padrão para Parcela Integral',
					'id'   => $prefix .'_TaxasParcelaIntegralDefault',
					'type' => 'wysiwyg',
					// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
					'raw'  => true,
					'std'  => '<strong>Taxa de Administração:</strong><br>
								Média Mensal: 0,25 %<br>
								Anual: 3,00 %<br>
								<br>
								<strong>Fundo de Reserva:</strong><br>
								Total: 1,00 %',
					// Editor settings, see wp_editor() function: look4wp.com/wp_editor
					'options' => array(
						'textarea_rows' => 7,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name' => 'Taxas padrão para Meia Parcela',
					'id'   => $prefix .'_TaxasMeiaParcelaDefault',
					'type' => 'wysiwyg',
					// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
					'raw'  => true,
					'std'  => '<strong>Taxa de Administração:</strong><br>
								Média Mensal: 0,25 %<br>
								Anual: 3,00 %<br>
								<br>
								<strong>Fundo de Reserva:</strong><br>
								Total: 1,00 %',
					// Editor settings, see wp_editor() function: look4wp.com/wp_editor
					'options' => array(
						'textarea_rows' => 7,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				// DIVIDER
				array(
					'type' => 'divider',
					'id'   => 'fake_divider_id', // Not used, but needed
				),
				// HEADING
				array(
					'type' => 'heading',
					'name' => 'Prazo Reduzido',
					'id'   => 'fake_id', // Not used but needed for plugin
				),					
				// CHECKBOX LIST
				array(
					'name' => "Exibir taxas",
					'id'   => $prefix ."_exibirTaxasPrazoReduzido",
					'type' => 'checkbox_list',
					// Options of checkboxes, in format 'value' => 'Label'
					'options' => array(
						$prefix .'_TaxasParcelaIntegralPrazoReduzidoDefault' => 'Parcela Integral',
						$prefix .'_TaxasMeiaParcelaPrazoReduzidoDefault'	 => 'Meia Parcela',
					),
				),
				
				array(
					'name' => 'Taxas padrão para Parcela Integral',
					'id'   => $prefix .'_TaxasParcelaIntegralPrazoReduzidoDefault',
					'type' => 'wysiwyg',
					// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
					'raw'  => true,
					'std'  => '<strong>Taxa de Administração:</strong><br>
								Média Mensal: 0,25 %<br>
								Anual: 3,00 %<br>
								<br>
								<strong>Fundo de Reserva:</strong><br>
								Total: 1,00 %',
					// Editor settings, see wp_editor() function: look4wp.com/wp_editor
					'options' => array(
						'textarea_rows' => 7,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name' => 'Taxas padrão para Meia Parcela',
					'id'   => $prefix .'_TaxasMeiaParcelaPrazoReduzidoDefault',
					'type' => 'wysiwyg',
					// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
					'raw'  => true,
					'std'  => '<strong>Taxa de Administração:</strong><br>
								Média Mensal: 0,25 %<br>
								Anual: 3,00 %<br>
								<br>
								<strong>Fundo de Reserva:</strong><br>
								Total: 1,00 %',
					// Editor settings, see wp_editor() function: look4wp.com/wp_editor
					'options' => array(
						'textarea_rows' => 7,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),	
			)
		);
		   


	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
