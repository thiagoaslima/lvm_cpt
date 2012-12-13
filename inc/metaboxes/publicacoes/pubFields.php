<!-- 
    // *********************************
	// PUBLICAÇÃO
	// *********************************
 -->
<?php

$category = 2;

if(isset($_GET["lvm_pub_cat"])){
	$category = $_GET["lvm_pub_cat"];
}

function pub_title ($category) {
	// All categories
	$titles = [
		"1" => "Título do artigo",
		"2" => "Título do livro",
		"3" => "Título do livro",
		"4" => "Título"
	];
	?>
	<!-- titulo da publicação -->
	<label for="lvm_pub_title"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_title" name="lvm_pub_title">
	<?php
};

function pub_options ($category) {
	if ($category == "2") {
		?>
		<!-- opções para livro --> 
		<input type="radio" class="lvm_pub_options" name="lvm_pub_options_1" value="Livro"> Livro publicado
		<input type="radio" class="lvm_pub_options" name="lvm_pub_options_1" value="Org"> Organização de obra publicada

		<!-- categoria -->
		<select class="lvm_pub_options" name="lvm_pub_options_2">
			<option value=""></option>
			<option value="Anais">Anais</option>
			<option value="Catálogo">Catálogo</option>
			<option value="Coletânea">Coletânea</option>
			<option value="Enciclopédia">Enciclopédia</option>
			<option value="Livro">Livro</option>
			<option value="Periódico">Periódico</option>
			<option value="Outro">Outro</option>
		</select>	
		<?php
	} else if ($category == "4"){
		?>
		<!-- opções para texto em jornal ou revista -->
		<input type="radio" class="lvm_pub_options" name="lvm_pub_options" value="Magazine"> Magazine
		<input type="radio" class="lvm_pub_options" name="lvm_pub_options" value="Jornal"> Jornal
		<label for="lvm_pub_options"><?php $argument; ?></label>
		<select name="lvm_pub_options" class="lvm_pub_options">
			<option value="magazine">Magazine</option>
			<option value="jornal">Jornal</option>
		</select>
		<?php
	} else if ($category == "5") {
		?>
		<!-- opções para anais de eventos -->
		<label for="lvm_pub_options"><?php $argument; ?></label>
		<select name="lvm_pub_options" class="lvm_pub_options">
			<option value="internacional">Internacional</option>
			<option value="nacional">Nacional</option>
			<option value="regional">Regional</option>
			<option value="local">Local</option>
		</select>
		<?php
	}
};

function pub_date ($category) {
	$currentYear = date("Y");
	$titles = [
		"1" => "Data da publicação",
		"2" => "Data da publicação",
		"3" => "Data da publicação"
	];
	?>
	<!-- data da publicação -->
	<label for="lvm_pub_date"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_date" name="lvm_pub_date_month">
	<select name="lvm_pub_date_month" class="lvm_pub_date">
		<option value="1">Janeiro</option>
		<option value="2">Fevereiro</option>
		<option value="3">Março</option>
		<option value="4">Abril</option>
		<option value="5">Maio</option>
		<option value="6">Junho</option>
		<option value="7">Julho</option>
		<option value="8">Agosto</option>
		<option value="9">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
	</select>
	<input type="number" class="lvm_pub_date" name="lvm_pub_date_year" placeholder="$currentYear">
	<input type="checkbox" class="lvm_pub_datePrev">previsão da publicação
	<?php
};


function pub_country ($category) {
	?>
	<!-- país da publicação -->
	<label for="lvm_pub_country">País</label>
	<select name="lvm_pub_country" class="lvm_pub_country">
		<option value="ARG">Argentina</option>
		<option value="AUS">Austrália</option>
		<option value="BRA" selected="">Brasil</option>
		<option value="CAN">Canadá</option>
		<option value="ESP">Espanha</option>
		<option value="EUA">Estados Unidos</option>
		<option value="FRA">França</option>
		<option value="GBR">Grã-Bretanha</option>
		<option value="HOL">Holanda</option>
		<option value="ING">Inglaterra</option>
		<option value="ITA">Itália</option>
		<option value="POR">Portugal</option>
		<option value="RFA">Alemanha</option>
		<option value="ABW">Aruba</option>
		<option value="AFG">Afeganistão</option>
		<option value="AFS">África Do Sul</option>
		<option value="AHL">Antilhas Holandesas</option>
		<option value="ALB">Albânia</option>
		<option value="ANB">Antigua</option>
		<option value="AND">Andorra</option>
		<option value="ANG">Angola</option>
		<option value="ARA">Arábia Saudita</option>
		<option value="ARL">Argélia</option>
		<option value="ARM">Armênia</option>
		<option value="ASM">Samoa Americana</option>
		<option value="ATC">Antartida</option>
		<option value="AUT">Austria</option>
		<option value="AZE">Azerbaijão</option>
		<option value="BAR">Barein</option>
		<option value="BEA">Belarus</option>
		<option value="BEL">Bélgica</option>
		<option value="BEN">Benin</option>
		<option value="BER">Bermudas</option>
		<option value="BGD">Bangladesh</option>
		<option value="BHS">Bahamas</option>
		<option value="BIR">Birmânia</option>
		<option value="BKF">Burkina Fasso</option>
		<option value="BLZ">Belize</option>
		<option value="BOL">Bolívia</option>
		<option value="BOS">Bósnia</option>
		<option value="BOT">Botsuana</option>
		<option value="BRB">Barbados</option>
		<option value="BRN">Brunei</option>
		<option value="BUL">Bulgária</option>
		<option value="BUR">Burundi</option>
		<option value="BUT">Butão</option>
		<option value="CAM">Camarões</option>
		<option value="CAT">Catar</option>
		<option value="CAZ">Cazaquistão</option>
		<option value="CBJ">Camboja</option>
		<option value="CBV">Cabo Verde</option>
		<option value="CCK">Ilhas Cocos</option>
		<option value="CHA">Chade</option>
		<option value="CHL">Chile</option>
		<option value="CHN">China</option>
		<option value="CHP">Chipre</option>
		<option value="CIN">Cingapura</option>
		<option value="CMF">Costa Do Marfim</option>
		<option value="COK">Ilhas Cook</option>
		<option value="COL">Colômbia</option>
		<option value="COM">Comores</option>
		<option value="CON">Congo</option>
		<option value="CRC">Costa Rica</option>
		<option value="CRN">Coréia Do Norte</option>
		<option value="CRO">Croácia</option>
		<option value="CRS">Coréia Do Sul</option>
		<option value="CUB">Cuba</option>
		<option value="CXR">Christmas Island</option>
		<option value="CYM">Ilhas Cayman</option>
		<option value="DIN">Dinamarca</option>
		<option value="DJI">Djibuti</option>
		<option value="DOM">República Dominicana</option>
		<option value="DON">Dominica</option>
		<option value="EAU">Emirados Árabes</option>
		<option value="EGI">Egito</option>
		<option value="ELS">El Salvador</option>
		<option value="EQU">Equador</option>
		<option value="ERT">Eritréa</option>
		<option value="ESC">Escócia</option>
		<option value="ESH">Western Sahara</option>
		<option value="EST">Estônia</option>
		<option value="ETP">Etiópia</option>
		<option value="FIL">Filipinas</option>
		<option value="FIN">Finlândia</option>
		<option value="FJI">Fiji</option>
		<option value="FLK">Ilhas Falkland</option>
		<option value="FOR">Formosa</option>
		<option value="FSM">Micronésia</option>
		<option value="GAB">Gabão</option>
		<option value="GAL">Gales</option>
		<option value="GAM">Gâmbia</option>
		<option value="GAN">Gana</option>
		<option value="GDL">Guadalupe</option>
		<option value="GEO">Geórgia</option>
		<option value="GFR">Guiana Francesa</option>
		<option value="GIB">Gibraltar</option>
		<option value="GNB">Guiné Bissau</option>
		<option value="GNE">Guiné</option>
		<option value="GNQ">Guiné Equatorial</option>
		<option value="GRD">Granada</option>
		<option value="GRE">Grécia</option>
		<option value="GRL">Groênlandia</option>
		<option value="GUA">Guatemala</option>
		<option value="GUI">Guiana</option>
		<option value="GUM">Guam</option>
		<option value="HKG">Hong Kong</option>
		<option value="HON">Honduras</option>
		<option value="HTI">Haiti</option>
		<option value="HUN">Hungria</option>
		<option value="IDN">Indonésia</option>
		<option value="IEM">Iêmem</option>
		<option value="IFA">Ilhas Faroe</option>
		<option value="IMH">Ilhas Marshall</option>
		<option value="IMS">Iêmen Do Sul</option>
		<option value="IND">Índia</option>
		<option value="IOT">Britsh Indian Ocean</option>
		<option value="IRA">Irã</option>
		<option value="IRL">Irlanda</option>
		<option value="IRN">Irlanda Do Norte</option>
		<option value="IRQ">Iraque</option>
		<option value="ISL">Islândia</option>
		<option value="ISR">Israel</option>
		<option value="IUG">Iugoslávia</option>
		<option value="IVA">Ilhas Vírgens Eua</option>
		<option value="JAM">Jamaica</option>
		<option value="JAP">Japão</option>
		<option value="JOR">Jordânia</option>
		<option value="KIR">Kiribati</option>
		<option value="KNA">São Cristóvão Nevis</option>
		<option value="KWT">Kuweit</option>
		<option value="LAO">Laos</option>
		<option value="LBN">Líbano</option>
		<option value="LBR">Libéria</option>
		<option value="LCA">Santa Lúcia</option>
		<option value="LES">Lesoto</option>
		<option value="LET">Letônia</option>
		<option value="LIB">Líbia</option>
		<option value="LIE">Liechtenstein</option>
		<option value="LIT">Lituânia</option>
		<option value="LUX">Luxemburgo</option>
		<option value="MAC">Macau</option>
		<option value="MAD">Madagascar</option>
		<option value="MAL">Malásia</option>
		<option value="MAR">Marrocos</option>
		<option value="MAU">Maurício</option>
		<option value="MBQ">Moçambique</option>
		<option value="MCD">Macedônia</option>
		<option value="MDV">Maldivas</option>
		<option value="MEX">México</option>
		<option value="MGL">Mongólia</option>
		<option value="MID">Ilhas Midway</option>
		<option value="MLI">Mali</option>
		<option value="MLT">Malta</option>
		<option value="MLV">Malavi</option>
		<option value="MMR">Mianmar</option>
		<option value="MOL">Moldova</option>
		<option value="MON">Mônaco</option>
		<option value="MRT">Martinica</option>
		<option value="MSR">Montserrat</option>
		<option value="MTN">Mauritânia</option>
		<option value="NAM">Namíbia</option>
		<option value="NCL">Nova Caledônia</option>
		<option value="NFK">Ilhas Norfolk</option>
		<option value="NGA">Nigéria</option>
		<option value="NIC">Nicarágua</option>
		<option value="NIG">Niger</option>
		<option value="NIU">Niue</option>
		<option value="NOR">Noruega</option>
		<option value="NPL">Nepal</option>
		<option value="NRU">Nauru</option>
		<option value="NZL">Nova Zelândia</option>
		<option value="OMA">Omã</option>
		<option value="PAN">Panamá</option>
		<option value="PAQ">Paquistão</option>
		<option value="PCI">Pacific Islands</option>
		<option value="PCN">Pitcairn</option>
		<option value="PER">Peru</option>
		<option value="PLF">Polinésia Francesa</option>
		<option value="PLU">Palau</option>
		<option value="PNG">Papua Nova Guiné</option>
		<option value="POL">Polônia</option>
		<option value="PRG">Paraguai</option>
		<option value="PTR">Porto Rico</option>
		<option value="QUE">Quênia</option>
		<option value="QUI">Quirgistão</option>
		<option value="RCA">Rep.Centro-Africana</option>
		<option value="REU">Reunião</option>
		<option value="ROM">Romênia</option>
		<option value="RS">Sérvia</option>
		<option value="RSS">Rússia</option>
		<option value="RTC">República Tcheca</option>
		<option value="RUA">Ruanda</option>
		<option value="SAM">Samoa Ocidental</option>
		<option value="SEN">Senegal</option>
		<option value="SHN">Ilhas Santa Helena</option>
		<option value="SIR">Síria</option>
		<option value="SLB">Ilhas Salomão</option>
		<option value="SMR">San Marino</option>
		<option value="SOM">Somália</option>
		<option value="SPM">São Pedro Miquelon</option>
		<option value="SRI">Sri Lanka</option>
		<option value="SRL">Serra Leoa</option>
		<option value="STP">São Tomé E Príncipe</option>
		<option value="SUA">Suazilândia</option>
		<option value="SUD">Sudão</option>
		<option value="SUE">Suécia</option>
		<option value="SUI">Suiça</option>
		<option value="SUR">Suriname</option>
		<option value="SVK">Eslováquia</option>
		<option value="SVN">Eslovênia</option>
		<option value="SYC">Seychelles</option>
		<option value="TAD">Tadjaquistão</option>
		<option value="TAI">Tailândia</option>
		<option value="TAN">Tanzânia</option>
		<option value="TCA">Ilhas Turcas Caicos</option>
		<option value="TCH">República Tcheca</option>
		<option value="TGO">Togo</option>
		<option value="TKL">Tokelau</option>
		<option value="TMP">Timor</option>
		<option value="TON">Tonga</option>
		<option value="TRT">Trinidad E Tobago</option>
		<option value="TUC">Turcomenistão</option>
		<option value="TUN">Tunísia</option>
		<option value="TUR">Turquia</option>
		<option value="TUV">Tuvalu</option>
		<option value="UCR">Ucrânia</option>
		<option value="UGA">Uganda</option>
		<option value="URS">União Soviética</option>
		<option value="URU">Uruguai</option>
		<option value="UZB">Uzbekistan</option>
		<option value="VAT">Vaticano</option>
		<option value="VCT">São Vicente Granadi</option>
		<option value="VEN">Venezuela</option>
		<option value="VGB">Ilhas Vírgens Gbr</option>
		<option value="VTN">Vietnã</option>
		<option value="VUT">Vanuatu</option>
		<option value="WAK">Ilhas Wake</option>
		<option value="WLF">Ilhas Wallis Futuna</option>
		<option value="ZAN">Zâmbia</option>
		<option value="ZAR">Zaire</option>
		<option value="ZIN">Zimbabue</option>
	</select>
	<?php
};

function pub_lang ($category) {
	?>
	<!-- idioma da publicação -->
	<label for="lvm_pub_lang">Idioma da publicação</label>
	<select name="lvm_pub_lang" class="lvm_pub_lang">
		<option value="DE">Alemão</option>
		<option value="ES">Espanhol</option>
		<option value="FR">Francês</option>
		<option value="EN">Inglês</option>
		<option value="IT">Italiano</option>
		<option value="PT" selected="">Português</option>
		<option value="AB">Abhkazian</option>
		<option value="AA">Afar</option>
		<option value="AF">Afrikaans</option>
		<option value="AY">Aimara</option>
		<option value="SQ">Albanês</option>
		<option value="AM">Amarico</option>
		<option value="AR">Árabe</option>
		<option value="AN">Armênio</option>
		<option value="AS">Assames</option>
		<option value="AZ">Azerbaidjano</option>
		<option value="BC">Baluchi</option>
		<option value="EU">Basco</option>
		<option value="BA">Bashquir</option>
		<option value="BN">Bengali</option>
		<option value="BB">Berbere</option>
		<option value="BE">Bielo-Russo</option>
		<option value="BH">Bihari</option>
		<option value="BM">Birmanês</option>
		<option value="BI">Bislama</option>
		<option value="BR">Bretão</option>
		<option value="BG">Búlgaro</option>
		<option value="CB">Cabie</option>
		<option value="KS">Cachemiriano</option>
		<option value="KM">Cambodjano</option>
		<option value="KN">Canadá</option>
		<option value="KK">Casaque</option>
		<option value="CA">Catalão</option>
		<option value="ZH">Chinês</option>
		<option value="SI">Cingalês</option>
		<option value="KO">Coreano</option>
		<option value="CO">Corsico</option>
		<option value="CR">Crioulo</option>
		<option value="HR">Croata</option>
		<option value="KU">Curdo</option>
		<option value="DA">Dinamarquês</option>
		<option value="DI">Divehi</option>
		<option value="DZ">Dzongka</option>
		<option value="FY">Erisão</option>
		<option value="SK">Eslovaco</option>
		<option value="SL">Esloveno</option>
		<option value="EO">Esperanto</option>
		<option value="ET">Estoniano</option>
		<option value="EE">Eue</option>
		<option value="FO">Feróico</option>
		<option value="FJ">Fijiano</option>
		<option value="FL">Filipino</option>
		<option value="FI">Finlandês</option>
		<option value="GD">Gaelico Escocês</option>
		<option value="GL">Galego</option>
		<option value="CY">Galês</option>
		<option value="KA">Georgiano</option>
		<option value="EL">Grego</option>
		<option value="KL">Groenlandês</option>
		<option value="GN">Guarani</option>
		<option value="GU">Gujarati</option>
		<option value="HY">Harmênio</option>
		<option value="HA">Hausa</option>
		<option value="IW">Hebraico</option>
		<option value="HI">Hindi</option>
		<option value="NL">Holandês</option>
		<option value="HU">Húngaro</option>
		<option value="JI">Iidiche</option>
		<option value="IN">Indonésio</option>
		<option value="IA">Interlíngua</option>
		<option value="IE">Interlíngue</option>
		<option value="IK">Inupiak</option>
		<option value="ID">Ioma</option>
		<option value="GA">Irlandês</option>
		<option value="IS">Islandês</option>
		<option value="JA">Japonês</option>
		<option value="JV">Javanês</option>
		<option value="LO">Laosiano</option>
		<option value="LP">Lapão</option>
		<option value="LA">Latim</option>
		<option value="LV">Letão</option>
		<option value="LB">Libras</option>
		<option value="LN">Lingála</option>
		<option value="LT">Lituano</option>
		<option value="LX">Luxemburguês</option>
		<option value="MK">Macedônio</option>
		<option value="ML">Malaiala</option>
		<option value="MS">Malaio</option>
		<option value="MG">Malgaxe</option>
		<option value="MT">Maltês</option>
		<option value="MA">Mandingo</option>
		<option value="MI">Maori</option>
		<option value="MR">Maratí</option>
		<option value="MO">Moldavio</option>
		<option value="MN">Mongol</option>
		<option value="NA">Nauruano</option>
		<option value="NE">Nepali</option>
		<option value="NO">Norueguês</option>
		<option value="OR">Oria</option>
		<option value="OM">Oromo</option>
		<option value="FA">Persa</option>
		<option value="PL">Polonês</option>
		<option value="PA">Punjabi</option>
		<option value="PS">Pushto</option>
		<option value="QU">Quichua</option>
		<option value="RW">Quiniaruanda</option>
		<option value="KY">Quirquiz</option>
		<option value="RN">Quirundi</option>
		<option value="QI">Quisuahili</option>
		<option value="RM">Reto-Romano</option>
		<option value="RO">Romeno</option>
		<option value="RU">Russo</option>
		<option value="SM">Samoano</option>
		<option value="SG">Sango</option>
		<option value="SA">Sanscrito</option>
		<option value="SR">Serbian</option>
		<option value="SH">Servo-Croata</option>
		<option value="ST">Sesoto</option>
		<option value="TN">Setsuana</option>
		<option value="SN">Shona</option>
		<option value="SD">Sindi</option>
		<option value="MY">Sirmanês</option>
		<option value="SS">Sisvati</option>
		<option value="SO">Somali</option>
		<option value="SW">Suaili</option>
		<option value="SU">Sudanês</option>
		<option value="SV">Sueco</option>
		<option value="TG">Tadjique</option>
		<option value="TH">Tai</option>
		<option value="TL">Talagog</option>
		<option value="TA">Tamil</option>
		<option value="TT">Tatar</option>
		<option value="CS">Tcheco</option>
		<option value="TE">Telugo</option>
		<option value="BO">Tibetano</option>
		<option value="TI">Tigrina</option>
		<option value="TO">Tongalês</option>
		<option value="TS">Tsonga</option>
		<option value="TW">Tui</option>
		<option value="TR">Turco</option>
		<option value="TK">Turcomano</option>
		<option value="TU">Tuvaloano</option>
		<option value="UK">Ucraniâno</option>
		<option value="UR">Urdu</option>
		<option value="UZ">Uzbeco</option>
		<option value="VI">Vietnamita</option>
		<option value="VO">Volupak</option>
		<option value="WO">Wolof</option>
		<option value="XH">Xosa</option>
		<option value="YO">Yoruba</option>
		<option value="ZU">Zulú</option>
		<option value="OU">Outros</option>
	</select>
	<?php
};

function pub_media ($category) {
	$titles = [
		"1" => "Meio de divulgação",
		"2" => "Meio de divulgação",
		"3" => "Meio de divulgação",
	];
	?>
	<!-- mídia da publicação / texto em jornal ou revista -->
	<label for="lvm_pub_media"><?php $titles[$category]; ?></label>
	<select name="lvm_pub_media" class="lvm_pub_media">
		<option value=""></option>	
		<option value="Impresso">Impresso</option>
		<option value="Meio magnético">Meio magnético</option>
		<option value="Meio digital">Meio digital</option>
		<option value="Filme">Filme</option>
		<option value="Hipertexto">Hipertexto</option>
		<option value="Impresso e mídia eletrônica">Impresso e mídia eletrônica</option>
		<option value="Outro">Outro</option>
	</select>
	<?php
};

function pub_host ($category) {
	$titles = [
		"1" => "Home page do trabalho (url)",
		"2" => "Home page do trabalho (url)",
		"3" => "Home page do trabalho (url)"
	]
	?>
	<!-- url do trabalho -->
	<label for="lvm_pub_host"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_host" name="lvm_pub_url">
	<?php
};


// *********************************
// EVENTO
// *********************************

function pub_evt_class ($category) {
	$titles = [
		"1" => false,
		"2" => false
	]; 	?>
	<label for="lvm_pub_evt_class"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_evt_class" name="lvm_pub_evt_class">
	<?php
};

function pub_evt_title ($category) {
	$titles = [
		"1" => false,
		"2" => false,
		"3" => false
	]; 	?>
	<label for="lvm_pub_evt_title"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_evt_title" name="lvm_pub_evt_title">
	<?php
};

function pub_evt_city ($category) {
	$titles = [
		"1" => false,
		"2" => false,
		"3" => false
	]; 	?>
	<label for="lvm_pub_evt_city"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_evt_city" name="lvm_pub_evt_city">
	<?php
};

function pub_evt_year ($category) {
	$titles = [
		"1" => false,
		"2" => false,
		"3" => false
	]; 	?>
	<label for="lvm_pub_evt_year"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_evt_year" name="lvm_pub_evt_year">
	<?php
};

// *********************************
// VEÍCULO
// *********************************

function pub_vei_title ($category) {
	$titles = [
		"1" => "Título do periódico/revista em que o artigo foi publicado",
		"2" => false,
		"3" => "Título do livro"
	]; ?>
	<label for="lvm_pub_vei_title"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_title" name="lvm_pub_vei_title">
	<?php
};

function pub_vei_org ($category) {
	$titles = [
		"1" => false,
		"2" => false,
		"3" => "Organizadores do livro"
	]; 	?>
	<label for="lvm_pub_vei_org"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_org" name="lvm_pub_vei_org">
	<?php
};

function pub_vei_isbn ($category) {
	$titles = [
		"1" => "ISSN",
		"2" => "ISBN",
		"3" => "ISBN"
	]; 	?>
	<label for="lvm_pub_vei_isbn"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_isbn" name="lvm_pub_vei_isbn">
	<?php
};

function pub_vei_volume ($category) {
	$titles = [
		"1" => "Volume",
		"2" => false,
		"3" => "Volume"
	]; 	?>
	<label for="lvm_pub_vei_volume"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_volume" name="lvm_pub_vei_volume">
	<?php
};

function pub_vei_volQty ($category) {
	$titles = [
		"1" => false,
		"2" => "Número de volumes",
		"3" => false
	]; 	?>
	<label for="lvm_pub_vei_volQty"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_volQty" name="lvm_pub_vei_volQty">
	<?php
};

function pub_vei_edition ($category) {
 	$titles = [
 		"1" => false,
 		"2" => "Número da edição",
 		"3" => "Número da edição"
 	]; ?>
 	<label for="lvm_pub_vei_edition"><?php $titles[$category]; ?></label>
 	<input type="text" class="lvm_pub_vei_edition" name="lvm_pub_vei_edition">
  	<?php
};

function pub_vei_serie ($category) {
	$titles = [
		"1" => "Série",
		"2" => "Série",
		"3" => "Série"
	]; 	?>
	<label for="lvm_pub_vei_serie"><?php $titles[$category]; ?></label>
	<input type="text" class="lvm_pub_vei_serie" name="lvm_pub_vei_serie">
	<?php
};

function pub_vei_iniPg ($category) {
	$titles = [
		"1" => "Página inicial/Número artigo eletrônico",
		"2" => "Número de páginas",
		"3" => "Página inicial"
	]; 	?>
	<label for="lvm_pub_vei_iniPg"><?php $titles[$category]; ?></label>
	<input type="number" class="lvm_pub_vei_iniPg" name="lvm_pub_vei_iniPg">
	<?php
};

function pub_vei_endPg ($category) {
	$titles = [
		"1" => "Página final",
		"2" => false,
		"3" => "Página final"
	]; 	?>
	<label for="lvm_pub_vei_endPg"><?php $titles[$category]; ?></label>
	<input type="number" class="lvm_pub_vei_endPg" name="lvm_pub_vei_endPg">
	<?php
};

function pub_vei_editora ($category) {
	$titles = [
		"1" => false,
		"2" => "Nome da editora",
		"3" => "Nome da editora"
	]; 	?>
	<label for="lvm_pub_vei_editora"><?php $titles[$category]; ?></label>
	<input type="number" class="lvm_pub_vei_editora" name="lvm_pub_vei_editora">
	<?php
};

function pub_vei_edCity ($category) {
	$titles = [
		"1" => "Página inicial/Número artigo eletrônico",
		"2" => "Cidade da editora",
		"3" => "Cidade da editora"
	]; 	?>
	<label for="lvm_pub_vei_edCity"><?php $titles[$category]; ?></label>
	<input type="number" class="lvm_pub_vei_edCity" name="lvm_pub_vei_edCity">
		<?php
};


// *********************************
// RENDER CATEGORY
// *********************************
if( isset($category) ){

	switch ($category) {
		case '1':
			$html = "<h2>Dados Pessoais</h2>";
			$html += pub_title($category);
			$html += pub_date($category);
			$html += pub_lang($category);
			$html += pub_media($category);
			$html += pub_host($category);
			$html += "<h2>Detalhamento</h2>";
			$html += pub_vei_title($category);
			$html += pub_vei_isbn($category);
			$html += pub_vei_volume($category);
			$html += pub_vei_serie($category);
			$html += pub_vei_iniPg($category);
			$html += pub_vei_endPg($category);
			break;
		
		case '2':
			$html = "<h2>Dados Pessoais</h2>";
			$html += pub_title($category);
			$html += pub_options($category);
			$html += pub_date($category);
			$html += pub_lang($category);
			$html += pub_media($category);
			$html += pub_host($category);
			$html += "<h2>Detalhamento</h2>";
			$html += pub_vei_volQty($category);
			$html += pub_vei_iniPg($category);
			$html += pub_vei_isbn($category);
			$html += pub_vei_edition($category);
			$html += pub_vei_serie($category);
			$html += pub_vei_edCity($category);
			$html += pub_vei_editora($category);
			break;

		case '3':
			$html = "<h2>Dados Pessoais</h2>";
			$html += pub_title($category);
			$html += pub_date($category);
			$html += pub_lang($category);
			$html += pub_media($category);
			$html += pub_host($category);
			$html += "<h2>Detalhamento</h2>";
			$html += pub_vei_title($category);
			$html += pub_vei_org($category);
			$html += pub_vei_volume($category);
			$html += pub_vei_iniPg($category);
			$html += pub_vei_endPg($category);
			$html += pub_vei_edition($category);
			$html += pub_vei_edCity($category);
			$html += pub_vei_editora($category);
			$html += pub_vei_serie($category);
			$html += pub_vei_edCity($category);
			$html += pub_vei_editora($category);
			break;
		
		default:

			break;
	}
}