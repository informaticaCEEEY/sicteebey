<?php
include ('checkSession.php');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="img/favicon_.png">

		<title>Cuestionarios de Contexto</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/buttonTop.css" rel="stylesheet">
		<link href="css/projects.css" rel="stylesheet">
		<link href="css/tabs.css" rel="stylesheet">
		<link href="css/callout.css" rel="stylesheet">
		<link rel="stylesheet" href="css/description.css">
		<link href="css/projectsTable.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="imports/js/offcanvas.js"></script>
		<script src="lib/bootstrap/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
        include ('header.php');
		?>
		<div class="container">
			<ul class="nav nav-pills nav-justified">
				<li class="active">
					<a href="#table0" data-toggle="pill"><h3>2015</h3></a>
				</li>
				<li>
					<a href="#table1" data-toggle="pill"><h3>2016</h3></a>
				</li>
				<li>
					<a href="#table2" data-toggle="pill"><h3>2017</h3></a>
				</li>
			</ul>
			<div class="tab-content">
				<br />
				<div id="table0" class="tab-pane fade active in">
					<h2 class="text-center">Cuestionarios de contexto 2015</h2>
					<hr />
					<div class="projects">
						<p>
							Las pruebas de contexto exploran factores que pueden influir en el logro educativo de los estudiantes, y explicar sus
							diferentes resultados, de aqu&iacute; la importancia del presente estudio que tiene como fin apoyar con instrumentos y
							resultados v&aacute;lidos y confiables a los principales actores educativos, investigadores y todo aquel interesado en
							mejorar la calidad educativa.
						</p>
						<p>
							La delimitaci&oacute;n del contenido es el resultado de una revisi&oacute;n de los cuestionarios de contexto aplicados en
							estudiantes de Educaci&oacute;n B&aacute;sica del estado de Yucat&aacute;n, pero desde una perspectiva de m&eacute;todos,
							t&eacute;cnicas y teor&iacute;as que implican la medici&oacute;n de variables psicol&oacute;gicas y educativas.
						</p>
						<p>
							De esta manera se utiliz&oacute; un &iacute;ndice cuya unidad de medida se le denomina escala logit, y puede tener
							valores desde puntuaciones muy bajas o negativas hasta valores muy altos o positivos, &plusmn;&infin;; de tal forma que los valores
							negativos indican menor intensidad o menos del factor medido por el conjunto de &iacute;tems; por el contrario, valores altos
							indican mayor intensidad o m&aacute;s cuant&iacute;a de dicho factor (Mart&iacute;nez-Arias &amp; Hern&aacute;ndez-LLoreda, 2014; Nering
							&amp; Ostini, 2011; Tejeda-Rojas, 1999).
						</p>

						<h4 class="text-left"><b>Acoso escolar durante las clases</b></h4>
						<p>
							El factor de acoso escolar contiene cuatro &iacute;tems que se enfocan a la percepci&oacute;n de la frecuencia en que los
							compa&ntilde;eros de aula realizan ciertas conductas durante las clases, que por su uso reiterativo pueden convertirse en
							hostigamiento  (Mar&iacute;n-Mart&iacute;nez &amp; Reidl-Mart&iacute;nez, 2013). Se seleccionaron &iacute;tems que involucran
							conductas de agresiones f&iacute;sicas y burlas entre compa&ntilde;eros y hacia el profesor.
						</p>
						<p>
							Siendo las peleas o empujones las conductas m&aacute;s comunes o frecuentes en las aulas, y la menos com&uacute;n o muy pocas
							veces se realizan burlas hacia los maestros. Los valores bajos indican menor intensidad de acoso escolar; por el contrario,
							valores altos indican mayor intensidad. El &iacute;ndice tiene valores entre -3.95 a 3.72, y una distribuci&oacute;n de
							puntuaciones hacia valores bajos.
						</p>

						<h4 class="text-left"><b>Apoyo y supervisi&oacute;n parental</b></h4>
						<p>
							Este factor se relaciona con el apoyo y supervisi&oacute;n de padres o tutores que involucran tanto actitudes de
							compresi&oacute;n, cari&ntilde;o y aceptaci&oacute;n con los hijos; como el monitoreo y control de cuestiones de
							disciplina escolar como las calificaciones, asistencia a la escuela y el repaso de tareas escolares (Hoeve, y otros, 2009).
							El listado &iacute;tems que conforman este factor se enlistan a continuaci&oacute;n:
						</p>
						<div class="text-justify" id="instructions">
							<ul class="custom-bullet">
								<li>
									Est&aacute; pendiente de tus calificaciones.
								</li>
								<li>
									Est&aacute; pendiente de tu asistencia a la escuela.
								</li>
								<li>
									Te expresa su afecto.
								</li>
								<li>
									Te apoya para que cumplas con las tareas o trabajos escolares.
								</li>
								<li>
									Te explica lo que no entiendes en clase.
								</li>
								<li>
									Te platica sobre tus dudas e inquietudes de temas que son de tu inter&eacute;s.
								</li>
								<li>
									Te pone a repasar lo que viste en la escuela.
								</li>
								<li>
									Te platica de temas familiares.
								</li>
							</ul>
						</div>
						<p>
							Siendo las actitudes control de las calificaciones y asistencia de los dos primeros &iacute;tems  las que se perciben con
							mayor frecuencia. Es un poco menos frecuente que alguno de los padres o tutor exprese su afecto, y la acci&oacute;n que es
							menos com&uacute;n que realicen los padres o tutores es platicar de temas familiares con el estudiante.
						</p>
						<p>
							En este factor el &iacute;ndice tiene valores entre -2.00 a 3.8; donde los valores bajos significan menos intensidad de la percepci&oacute;n de
							apoyo y supervisi&oacute;n de los padres; por el contrario, valores altos indican mayor intensidad del constructo evaluado. El promedio del Estado
							es de 0.85, con una distribuci&oacute;n hacia puntajes altos.
						</p>

						<h4 class="text-left"><b>Estatus socioecon&oacute;mico</b></h4>
						<p>
							Este factor est&aacute; conformado por siete &iacute;tems, que en conjunto miden aspectos relacionados con el nivel educativo
							de los padres y el ingreso econ&oacute;mico de la familia medido a trav&eacute;s de los bienes con los que cuentan los
							estudiantes en sus casas; este factor est&aacute; relacionado con las oportunidades que puede tener el sujeto en su
							educaci&oacute;n (Gil-Flores, 2013). Entre los bienes que considera el factor son el tener televisor, computadora
							(para tareas escolares), autom&oacute;vil, ba&ntilde;o completo y horno de microondas; adem&aacute;s, se pregunta el nivel
							m&aacute;ximo nivel de estudios alcanzado por la madre y el padre.
						</p>
						<p>
							De acuerdo con los resultados, algunos bienes o caracter&iacute;sticas son m&aacute;s dif&iacute;ciles de obtener y
							est&aacute;n asociadas con mayor nivel socioecon&oacute;mico, as&iacute; se observ&oacute; que a mayor nivel estudios
							del padre y la madre los estudiantes reportan un incremento en la cantidad de las siguientes caracter&iacute;sticas o
							bienes en el hogar: ba&ntilde;o completo, autom&oacute;vil, computadora para hacer tareas escolares, y el horno de
							microondas que es el bien menos com&uacute;n.
						</p>
						<p>
							Los valores bajos del &iacute;ndice indican menor ingreso econ&oacute;mico en la familia del estudiante; por el contrario,
							valores altos indican mayor ingreso econ&oacute;mico. La media del Estado es -0.9, y la distribuci&oacute;n del &iacute;ndice
							se inclina hacia valores bajos.
						</p>

						<h4 class="text-left"><b>Uso de la lengua maya</b></h4>
						<p>
							Este factor est&aacute; compuesto de siete &iacute;tems que miden el grado en que el estudiante usa la lengua maya; adem&aacute;s, como una lengua
							se vincula con aspectos como un territorio com&uacute;n, el parentesco sanguino y las costumbres, por lo anterior se considera que
							este factor tiene una fuerte vinculaci&oacute;n con la identidad &eacute;tnica (Chihu-Ampar&aacute;n, 2002). Los valores bajos indican menor uso
							de la lengua maya; por el contrario, valores altos indican mayor uso. El promedio del estado es -0.7, y la distribuci&oacute;n del
							&iacute;ndice se inclina hacia valores bajos.
						</p>
						<p>
							Los resultados muestran que cuando m&aacute;s arraigado tienen el uso de la lengua maya, lo primero que caracteriza a los estudiantes
							es que primero hablan maya y luego espa&ntilde;ol, seguido de hablar maya con la familia y amigos; y aunque se presenten las
							siguientes caracter&iacute;sticas, estas repercuten en menor medida en su uso: los padres estimulen al estudiante aprender maya,
							y que los padres hablen maya.
						</p>

						<h4 class="text-left"><b>T&eacute;cnicas para el estudio</b></h4>
						<p>
							Este factor, conformado por siete &iacute;tems, refiere a acciones que realiza el estudiante para estudiar como leer apuntes,
							memorizar, repetir ejercicios y hacer esquemas. Los valores bajos del &iacute;ndice se&ntilde;alan poco uso de t&eacute;cnicas de
							estudio; por el contrario, valores altos indican mayor uso. El promedio del Estado es 0.5, y la distribuci&oacute;n del
							&iacute;ndice se inclina hacia valores altos.
						</p>
						<p>
							Se encontr&oacute; que poner atenci&oacute;n a las lecciones durante las clases es la acci&oacute;n m&aacute;s recurrente que
							cualquier otra para estudiar; despu&eacute;s recurren a leer sus apuntes o el libro de texto; luego a realizar ejercicios
							diferentes a los del libro de texto seguido de memorizar sus apuntes o el libro de texto. Y las t&eacute;cnicas de estudio
							que menos realizan los estudiantes son las que implican desarrollar esquemas, res&uacute;menes o gu&iacute;as; y repetir los
							ejercicios del cuaderno o del libro de texto.
						</p>

						<h4 class="text-left"><b>Motivaci&oacute;n de logro (exigencia y constancia)</b></h4>
						<p>
							Este factor conformado por tres &iacute;tems explora la determinaci&oacute;n del estudiante para lograr ciertas metas escolares
							(Deci &amp; Ryan, 2008; Flores-Mac&iacute;as &amp; G&oacute;mez-Bastida, 2010). Los resultados muestran que los estudiantes se perciben como
							personas que terminan lo que empiezan, aunque se perciben con menor esmero. Puntajes altos de su &iacute;ndice se&ntilde;alan que el
							estudiante se encuentra altamente motivado, por el contrario puntajes bajo se&ntilde;alan poco motivaci&oacute;n de logro. El promedio
							del estado es 1.0 y la distribuci&oacute;n de las puntaciones se inclina hacia valores altos.
						</p>

						<h4 class="text-center"><b>Autoeficacia</b></h4>
						<p>
							Las creencias de autoeficacia son pensamientos sobre la confianza para lograr una meta, mediante el control de la conducta,
							la motivaci&oacute;n y el afecto; adem&aacute;s, son espec&iacute;ficas de alguna situaci&oacute;n en la cual est&aacute;n
							involucrados los sujetos en este caso los estudiantes (Bandura, 1977, 1982, 1986, 1997, 1999, 2006). En virtud de que este marco
							conceptual ha sido fundamental en estudios internacionales en torno a la mejora de la calidad de la educaci&oacute;n
							(OCDE, 2006, 2013; OCDE &amp; INECSE, 2004), se decidi&oacute; explorar la confianza del estudiante a) para lograr su aprendizaje,
							b) en la soluci&oacute;n de ciertos problemas en matem&aacute;ticas, c) en la comprensi&oacute;n e interpretaci&oacute;n de
							textos y d) para la lectura de textos en ingl&eacute;s. Para el caso del primer factor se aplic&oacute; de 3&deg; a 6&deg; grado, los
							dem&aacute;s factores s&oacute;lo se aplicaron en ni&ntilde;os de sexto grado de educaci&oacute;n primaria.
						</p>
						<h4 class="text-left"><b>Autoeficacia para el aprendizaje</b></h4>
						<p>
							Conformado por cinco &iacute;tems que refieren a la convicci&oacute;n del estudiante de su capacidad para regular su propio
							aprendizaje como fijarse metas, auto-monitorearse y el uso de estrategias de estudio (Pajares &amp; Schunk, 2002;
							Zimmerman &amp; Kitsantas, 2005). Los valores bajos del &iacute;ndice se&ntilde;alan poca convicci&oacute;n de su capacidad
							para controlar su aprendizaje; y valores altos indican m&aacute;s convicci&oacute;n. El promedio del Estado es 1.0, y la
							distribuci&oacute;n del &iacute;ndice se inclina hacia valores altos.
						</p>
						<p>
							Los resultados muestran que los estudiantes se perciben con m&aacute;s habilidad para cumplir con las tareas marcadas y
							ponerse al d&iacute;a cuando se atrasa en las tareas, despu&eacute;s consideran que tienen menos habilidad de relacionar
							los conceptos que ya conoce con los nuevos, por &uacute;ltimo perciben que tienen poca habilidad para ponerse al corriente
							cuando han faltado o se est&aacute;n atrasando en clases.
						</p>

						<h4 class="text-left"><b>Autoeficacia en matem&aacute;ticas</b></h4>
						<p>
							El factor autoeficacia en matem&aacute;ticas, compuesto de cuatro &iacute;tems, refiere a la convicci&oacute;n del estudiante
							de resolver satisfactoriamente problemas de matem&aacute;ticas (OCDE, 2013, 2015). En este estudio se cuestion&oacute; el
							sentido num&eacute;rico y algebraico. Los resultados muestran que los estudiantes de sexto grado se sienten con m&aacute;s
							confianza en identificar la parte entera y decimal de un n&uacute;mero y utilizar los criterios de divisibilidad en la
							identificaci&oacute;n del residuo; y lo que m&aacute;s consideran que se les dificulta es identificar los elementos de una
							ecuaci&oacute;n, aunque esto &uacute;ltimo se ense&ntilde;a con mayor profundidad en el nivel de secundaria.
						</p>

						<h4 class="text-left"><b>Autoeficacia para la comprensi&oacute;n e interpretaci&oacute;n de textos</b></h4>
						<p>
							Las percepciones de la propia confianza del estudiante para leer de manera eficaz, influye en la comprensi&oacute;n del texto, y
							est&aacute;n asociadas en forma positiva con diferentes medidas de rendimiento lector (Schunk &amp; Rice, 1993). Por lo anterior
							se construyeron cuatro &iacute;tems que abordan aspectos como extraer las ideas principales, encontrar las semejanzas y
							diferencias, transcribir los mitos y leyendas e identificar sus caracter&iacute;sticas. Los valores bajos del &iacute;ndice
							se&ntilde;alan poca confianza de su capacidad para leer de manera eficaz; y valores altos indican m&aacute;s confianza.
							El promedio del Estado es 1.6, aunque en 38 escuelas se muestran valores muy bajos con un promedio de -2.8; y la
							distribuci&oacute;n del &iacute;ndice se inclina hacia valores altos.
						</p>
						<p>
							Los resultados muestran que se sienten con m&aacute;s confianza para extraer las ideas principales de un mismo tema en
							distintas fuentes de informaci&oacute;n, seguido de identificar las caracter&iacute;sticas de un mismo mito y leyenda en diferentes
							cultura; pero en que menos capaces se perciben es en encontrar las semejanzas y diferencias de una misma noticia en
							diferentes medios de comunicaci&oacute;n.
						</p>

						<h4 class="text-left"><b>Autoeficacia para leer texto en ingl&eacute;s</b></h4>
						<p>
							Este factor, compuesto de tres &iacute;tems, valora la confianza del estudiante para leer textos escritos en idioma
							ingl&eacute;s (CENEVAL, 2013). Los valores bajos del &iacute;ndice se&ntilde;alan poca confianza de su capacidad para leer
							textos en ingl&eacute;s; y valores altos indican m&aacute;s confianza. El promedio del Estado es -.38, y la
							distribuci&oacute;n del &iacute;ndice se inclina hacia valores bajos. Se encontr&oacute; que los estudiantes se perciben
							con m&aacute;s confianza en comprender informaci&oacute;n en ingl&eacute;s del internet, y perciben menos confianza en
							comprender libros de esparcimiento escritos en ingl&eacute;s.
						</p>

						<h3 class="text-center"><b>REFERENCIAS</b></h3>
						<br />
						<div class="bibliographicReferences">
							<p>
								Bandura, A. (1977). Self-efficacy: Toward a unifying theory of behavioral change. <cite>Psychological  Review</cite>,
								84, 191-215.
							</p>
							<p>
								Bandura, A. (1982). Self-efficacy mechanism in human agency. <cite>American Psychologist, 37</cite>, 122-147.
							</p>
							<p>
								Bandura, A. (1986). <cite>Social Foundations of Thought and Action: A social cognitive theory.</cite> Englewood Cliffs,
								New Jersey, USA: Prentice Hall.
							</p>
							<p>
								Bandura, A. (1997). <cite>Self-efficacy: The exercise of control.</cite> New York, USA: Freeman.
							</p>
							<p>
								Bandura, A. (1999). <cite>Autoeficacia: c&oacute;mo afrontamos los cambios de la sociedad actual.</cite>
								Espa&ntilde;a: Editorial Descl&eacute;e de Broewer.
							</p>
							<p>
								Bandura, A. (2006). Guide for constructing self-efficacy scales. In F. Pajares, &amp; T. Urdan , <cite>Self-efficacy beliefs
									of adolescents</cite> (pp. 307-337). Greenwich, CT: Information Age Publishing.
							</p>
							<p>
								CENEVAL. (2013). <cite>Plan de desarrollo del sistema de integral de cuestionarios de contexto.</cite> M&eacute;xico:
								Centro Nacional de Evaluaci&oacute;n para la Educaci&oacute;n Superior, A.C.
							</p>
							<p>
								Chihu-Ampar&aacute;n, A. (2002). <cite>Sociolog&iacute;a de la identidad.</cite> M&eacute;xico: Universidad Aut&oacute;noma
								Metropolitana, Unidad Iztapalapa.
							</p>
							<p>
								Deci, E., &amp; Ryan, R. (2008). Self-determination theory: A macrotheory of human motivation, development, and health.
								<cite>Canadian Psychology/Psychologie canadienne, 49</cite>(3), 182-185.
							</p>
							<p>
								Flores Mac&iacute;as, R. d., &amp; G&oacute;mez Batista, J. (2010). Un estudio sobre la motivaci&oacute;n hacia la escuela
								secundaria en estudiantes mexicanos. <cite>Revista Electr&oacute;nica de Investigaci&oacute;n Educativa, 12</cite>(1).
							</p>
							<p>
								Gil-Flores, J. (2013). Medici&oacute;n del nivel socioecon&oacute;mico familiar en el alumnado de Educaci&oacute;n Primaria.
								<cite>Revista de Educaci&oacute;n, 362,</cite> 298-322.
							</p>
							<p>
								Hoeve, M., Dubas, J. S., Eichelsheim, V., van der Laan, P., Smeenk, W., &amp; Gerris, J. (2009). The Relationship Between
								Parenting and Delinquency:. <cite>Journal of abnormal child psychology, 37</cite>(6), 749-775.
							</p>
							<p>
								Mar&iacute;n-Mart&iacute;nez, A., &amp; Reidl-Mart&iacute;nez, L. (2013). Validaci&oacute;n psicom&eacute;trica del
								cuestionario" As&iacute; nos llevamos en la escuela" para evaluar el hostigamiento escolar (bullying) en primarias.
								<cite>Revista Mexicana de Investigaci&oacute;n Educativa, 18</cite>(54), 11-36.
							</p>
							<p>
								Mart&iacute;nez-Arias, R., &amp; Hern&aacute;ndez-LLoreda, M. (2014). 7. Modelos polit&oacute;micos de la teor&iacute;a
								de respuesta al &iacute;tem. In R. Mart&iacute;nez-Arias, M. Hern&aacute;ndez-LLoreda, &amp; M. Her&aacute;ndez-Lloreda,
								<cite>Psicometr&iacute;a </cite>(pp. 193-218). Alianza Editorial.
							</p>
							<p>
								Nering, M., &amp; Ostini, R. (2011). <cite>Handbook of polytomous item response theory models.</cite> New York: Routledge,
								Taylor &amp; Francis.
							</p>
							<p>
								OCDE. (2006). <cite>PISA 2006. Marco de la evaluaci&oacute;n. </cite> Espa&ntilde;a: Santillana Educaci&oacute;n S.L.
							</p>
							<p>
								OCDE. (2013). <cite>PISA 2012 Results: Ready to Learn (Volume III): Students' Engagement, Drive and Self-Beliefs. </cite>
								PISA, OECD Publishing. Retrieved from http://dx.doi.org/10.1787/9789264201170-en
							</p>
							<p>
								OCDE. (2015, Octubre). &iquest;Hasta qu&eacute; punto conf&iacute;an los alumnos en su capacidad para resolver problemas
								de matem&aacute;ticas? <cite>PISA in Focus</cite>, 1-4.
							</p>
							<p>
								OCDE; INECSE;. (2004). <cite>Marcos te&oacute;ricos de PISA 2003: la medida de los conocimientos y destrezas en
									matem&aacute;ticas, lectura, ciencias y resoluci&oacute;n de problemas.</cite> Madrid: Ministerio de Educaci&oacute;n y Ciencia,
								Instituto Nacional de Evaluaci&oacute;n y Calidad del Sistema Educativo.
							</p>
							<p>
								Pajares, F., &amp; Schunk, D. (2002). Self and self-belief in psychology and education: A historical perspective.
								In J. Aronson, &amp; D. Cordova, <cite>Psychology of education: Personal and interpersonal forces.</cite> New York,
								USA: Academic Press.
							</p>
							<p>
								Schunk, D., &amp; Rice, J. (1993). Strategy fading and progress feedback: Effects on self-efficacy and. <cite>Journal of
									Special Education, 27,</cite> 257-276.
							</p>
							<p>
								Tejeda-Rojas, A. (1999). Aplicaci&oacute;n del modelo de escalas de clasificaci&oacute;n para la medici&oacute;n de la
								"acci&oacute;n pol&iacute;tica no convencional". <cite>Metodolog&iacute;a de Encuestas, 1</cite>(1), 1-18.
							</p>
							<p>
								Zimmerman, B., &amp; Kitsantas, A. (2005). Homework practices and academic achievement: The mediating role of self-efficacy
								and perceived responsibility beliefs. <cite>Contemporary Educational Psychology, 30</cite>(4), 397-417.
								doi:10.1016/j.cedpsych.2005.05.003
							</p>
						</div>
					</div>
				</div>
				<div id="table1" class="tab-pane fade active in">
					<h2 class="text-center">Cuestionarios de contexto 2016</h2>
					<div id="projects" class="projects">
    					<h3 class="text-left"><b>Ambiente escolar</b></h3>
    					<p>
    						El ambiente escolar es un conjunto de factores objetivos y subjetivos que interactúan e influyen
    						sobre el organismo del niño, adolescente o el joven en el desarrollo del proceso educativo y que
    						contribuyen de forma decisiva a la conservación y fortalecimiento del estado de salud y a su
    						formación general integral<sup><a href="#referencias2016">1</a></sup>.
    					</p>
    					<h4 class="text-left"><b><i>Interacción y maltrato entre compañeros (bullying)</i></b></h4>
    					<p>
    					   Este grupo cinco reactivos indagan la percepción que tiene el estudiante de su interacción con sus
    					   demás compañeros incluyendo la percepción de conductas de aceptación o agresión y la relación del
    					   maestro con el estudiante
    					</p>
    					<h4 class="text-left"><b><i>Relaci&oacute;n Maestro - estudiante</i></b></h4>
                        <p>
                            Son procesos de construcción e intercambio de conocimientos, conductas y procesos de pensamiento
                            entre quienes conviven en un salón de clases. Las interacciones educativas significativas deben
                            impulsar el enriquecimiento intelectual, social y cultural, tanto de los estudiantes como de los
                            maestros, al tiempo que permitan identificar y fomentar los intereses personales y las motivaciones
                            intrínsecas de los alumnos<sup><a href="#referencias2016">2</a></sup>.
                        </p>
                        <p>
                            Del constructo anterior se desprenden cinco reactivos que indagan la percepción del alumno sobre
                            las actitudes y conductas de los docentes hacia los estudiantes durante las actividades escolares
                            relacionadas con el proceso de enseñanza aprendizaje, en función de la motivación escolar,
                            reconocimiento, trato, etc.
                        </p>
                        <h3 class="text-left"><b>Salud y prevención de enfermedades no transmisibles</b></h3>
                        <p>
                        	La OMS define la salud como es un estado de completo bienestar físico, mental y social, y no
                        	solamente la ausencia de afecciones o enfermedades. En esta definición tienen cabida las denominadas
                        	enfermedades no transmisibles (ENT) como las cardiovasculares, el cáncer, las enfermedades
                        	respiratorias crónicas y la diabetes, las cuales causan 35 millones de defunciones cada año, y el
                        	80% de las cuales corresponden a países de ingresos bajos y medios; por lo anterior, son una amenaza
                        	para el sano desarrollo del ser humano, además de impactar en aspectos socioeconómicos<sup><a href="#referencias2016">3</a></sup>.
                        	Esta organización también destaca la desproporcional promoción mercadotécnica de alimentos y
                        	bebidas no alcohólicas con alto contenido de grasas, azúcar o sal que impacta en mantener el
                        	sobrepeso en los niños. México, y específicamente el estado de Yucatán, está entre los estados con
                        	mayores problemas de sobrepeso y obesidad en niños y adultos<sup><a href="#referencias2016">4</a></sup>, razón
                        	suficiente para que en estos cuestionarios se exploren aspectos relacionados con los hábitos
                        	alimenticios; además, se incluyen indicadores de obesidad infantil, los cuales fueron proporcionados
                        	por el Programa Integral para Combatir la Obesidad Infantil en Yucatán (PIAOY).
                        </p>
                        <h4 class="text-left"><i><b>Hábitos Alimentarios</b></i></h4>
                        <p>
							Los hábitos alimentarios se definen como el conjunto de conductas adquiridas por un individuo, por
							la repetición de actos en cuanto a la selección, la preparación y el consumo de alimentos. Asimismo
							las bebidas se definen como todos aquellos líquidos que ingieren los seres humanos, incluida el
							agua <sup><a href="#referencias2016">5</a></sup>. Estos elementos se relacionan principalmente con
							las características sociales, económicas y culturales de una población o región
							determinada<sup><a href="#referencias2016">6</a></sup>.
                        </p>
                        <p>
                            En el cuestionario se incluyó un conjunto de siete reactivos que refieren al tipo de alimento que
                            consume semanalmente y su frecuencia, en referencia alimentos pertenecientes a los tres
                            grupos: 1. Frutas y verduras, 2. Cereales y 3. Leguminosas y alimentos de origen animal;
                            así como alimentos procesados.
                            <br />
                            Adicionalmente se incluyen cinco reactivos de la frecuencia de consumo por día de diferentes tipos de bebidas, naturales o procesadas
                            y agua.
                        </p>

                        <h4 class="text-left"><i><b>Índice de Masa Corporal</b></i></h4>
                        <p>
                            El sobrepeso y la obesidad se definen como una acumulación anormal o excesiva de grasa que puede ser
                            perjudicial para la salud<sup><a href="#referencias2016">7</a></sup>.
                        </p>
                        <p>
                            El índice de masa corporal (IMC) descrito en 1832 por Quetelet representa, excluyendo periodos
                            acelerados del crecimiento, que el peso normalmente aumenta con el cuadrado de la estatura, este
                            indicador se calcula dividiendo el peso en kilos entre la talla en metros al cuadrado (kg/m<sup>2</sup>)
                            y se utiliza frecuentemente para identificar el sobrepeso y la obesidad pues existe
                            evidencia de su alta correlación con medidas de grasa en adultos<sup><a href="#referencias2016">8</a></sup>.
                            <br />
                            Con el aumento de peso en niños y al demostrarse que con ajustes por edad y sexo el IMC es un buen
                            indicador de adiposidad en niños<sup><a href="#referencias2016">9</a></sup>, diversos grupos han
                            desarrollado valores de referencia para su interpretación de entre los cuales los más utilizados son
                            los patrones de la Organización Mundial de la Salud (OMS) que describen el crecimiento idóneo de los
                            niños (0 a 5 años), escolares y adolescentes (5 a 19 años) en puntuaciones z
                            <sup><a href="#referencias2016">10</a></sup> <sup><a href="#referencias2016">11</a></sup>.
                            Las puntuaciones aquí presentadas son de niños de primaria y están clasificadas según las referencias del crecimiento de la
                            OMS de 5 a 19 años<sup><a href="#referencias2016">12</a></sup>.
                        </p>
                        <h3 class="text-left"><b>Contexto Familiar</b></h3>
                        <p>
                            En el contexto familiar intervienen cuatro dimensiones: a) composición, historia y factores
                            socioeconómicos, b) la dimensión afectiva-emocional, c) la dimensión referente al desarrollo de los
                            aprendizajes y d) la dimensión relativa a la organización y la estabilidad
                            <sup><a href="#referencias2016">13</a></sup>.
                        </p>
                        <h4 class="text-left"><b><i>Composición y Factores Socioeconómicos</i></b></h4>
                        <p>
                            Este grupo de cinco reactivos indaga aspectos relacionados con el lugar dónde vive el alumno que
                            incluye: personas con las que vive, si realiza alguna actividad laboral, el transporte que usa para
                            ir a la escuela y la percepción del alumno sobre las actitudes y conductas de sus padres en relación
                            a la afectividad y apoyo emocional hacia él mismo.
                        </p>

                        <h4 class="text-left"><b><i>Ambiente Afectivo-Emocional</i></b></h4>
                        <p>
                            La función afectiva de la familia es amplia y compleja, incluye las siguientes dimensiones:
                            las emociones, inteligencia emocional, sentimientos y aspectos afectivos de la comunicación familiar.
                            Estos componentes deben manifestarse de manera favorable, porque así influyen en la estabilidad,
                            así como en la armonía individual y del mencionado grupo social<sup><a href="#referencias2016">14</a></sup>.
                            Se incluyeron cuatro reactivos que indagan sobre estos aspectos.
                        </p>

                        <h4 class="text-left"><b><i>Organización y Estabilidad</i></b></h4>
                        <p>
                           Este constructo incluye al trabajo no remunerado que los miembros del hogar realizan en actividades
                           productivas para la generación de servicios destinados a la satisfacción de sus necesidades.
                           Incluye: alimentación, limpieza y mantenimiento de la vivienda, limpieza y cuidado de la ropa y
                           calzado, compras y administración del hogar, cuidados y apoyo<sup><a href="#referencias2016">15</a></sup>.
                           En el cuestionario se incorporó un reactivo que indaga las actividades que realiza el alumno en el
                           lugar donde vive y que tienen que ver con el cuidado y mantenimiento de la casa, las pertenencias y
                           los miembros de la familia.
                        </p>

                        <h3 class="text-left"><b>Identidad étnica</b></h3>
                        <h4 class="text-left"><b><i>Uso de la Lengua maya en el contexto familiar y escolar</i></b></h4>
                        <p>
                           Una lengua se vincula con aspectos como un territorio común, el parentesco sanguino y las costumbres,
                           por lo anterior se considera que este factor tiene una fuerte vinculación con la identidad étnica<sup><a href="#referencias2016">16</a></sup>.
                           Se incluyeron cinco reactivos que exploran si el alumno o su familia habla
                           maya, así como su uso en el contexto de la escuela.
                        </p>

						<h3 id="referencias2016" class="text-center"><b>REFERENCIAS</b></h3>
						<br />
						<div class="bibliographicReferences">
							<p>
								1. Fuentes, O. (2005). Algunas consideraciones acerca del ambiente escolar. <cite>Revista Órbita
								    Científica</cite> SPEJV, Ciudad de la Habana.
							</p>
							<p>
								2. SEP, 2016. <cite>Modelo Educativo 2016. México: SEP</cite>
							</p>
							<p>
								3. World Health Organization [WHO] (2010a). Conjunto de recomendaciones sobre la promoción de
								alimentos y bebidas no alcohólicas dirigida a los niños. Ginebra, Suiza: Ediciones de la OMS.
							</p>
							<p>
								4. OMENT [Observatorio Mexicano de Enfermedades no Transmisibles] (2015). Sistema de Indicadores
								para Monitorear los Avances de la Estrategia Nacional para la Prevención y el Control del
								Sobrepeso, la Obesidad y la Diabetes (ENPCSOD). <cite>Sistema de Indicadores. Reporte de resultados.</cite>
								Recuperado de  <a target="blank" href="http://oment.uanl.mx/indicadores/">http://oment.uanl.mx/indicadores/</a>
							</p>
							<p>
                                5. Rivera, J; Muñoz, O.; Rosas, M.; Aguilar, C.; Popkin, B. & Willett, W. (2008).
                                Consumo de bebidas para una vida saludable: recomendaciones para la población mexicana.
                                <cite>Salud Pública de México</cite>, 50(2), 173-195.
                            </p>
							<p>
							    6. Diario Oficial de la Federación (2013). Norma Oficial Mexicana-043-SSA2-2012, Servicios
							    básicos de salud. Promoción y educación para la salud en materia alimentaria. Criterios para
							    brindar orientación. Consultado el 11 de noviembre de 2016 en:
							    <a href="http://dof.gob.mx/nota_detalle.php?codigo=5285372&fecha=22/01/2013" target="blank">
							        http://dof.gob.mx/nota_detalle.php?codigo=5285372&fecha=22/01/2013</a>
							</p>
                            <p>
                                7. World Health Organization [WHO] (2010c). Nota descriptiva N. 311. Obesidad y Sobrepeso, consultado en <a target="blank" href="http://www.who.int/mediacentre/factsheets/fs311/es/">http://www.who.int/mediacentre/factsheets/fs311/es/</a> el 13 de Diciembre del 2016.
                            </p>
                            <p>
                                8. Eknoyan, G. (2008). Adolphe Quetelet (1796–1874)—the average man and indices of obesity.
                                <cite>Nephrology Dialysis Transplantation, 23(1), 47-51.
                            </p>
                            <p>
                                9. Bellizzi, M. C. & Dietz, W. H. (1999). Workshop on childhood obesity: summary of the discussion.
                                <cite>The American Journal of Clinical Nutrition</cite>, 70(1), 173s-175s.
                            </p>
                            <p>
                                10. Onis, M. (2006). WHO Child Growth Standards based on length/height, weight and age.
                                <cite>Acta paediatrica</cite>, 95(S450), 76-85.
                            </p>
                            <p>
                                11. Onis, M.; Onyango, A. W.; Borghi, E.; Siyam, A.; Nishida, C. & Siekmann, J. (2007).
                                Development of a WHO growth reference for school-aged children and adolescents.
                                <cite>Bulletin of the World health Organization</cite>, 85(9), 660-667.
                            </p>
                            <p>
                                12. World Health Organization [WHO] (2010b). Growth reference 5-19 years. BMI-for-age
                                (5-19 years), consultado el 13 de Diciembre de 2016 en:
                                <a href="http://www.who.int/growthref/who2007_bmi_for_age" target="blank">http://www.who.int/growthref/who2007_bmi_for_age</a>
                            </p>
                            <p>
                                13. Parra, J.; Gomariz, M. & Sánchez, M. (2011). El análisis del contexto familiar en la educación.
                                <cite>Revista Electrónica Interuniversitaria de Formación del Profesorado</cite>. 14 (1) Consultada el
                                15 de noviembre de 2016 en: <a href="http://www.aufop.com/aufop/uploaded_files/articulos/1301588607.pdf" target="blank">
                                    http://www.aufop.com/aufop/uploaded_files/articulos/1301588607.pdf</a>
                            </p>
                            <p>
                                14. Pi, A. & Cobián, A. (2009). Componentes de la función afectiva familiar: una nueva visión de
                                sus dimensiones e interrelaciones. <cite>MEDISAN</cite> v.13 n.6 Santiago de Cuba. Consultado el
                                15 de noviembre de 2016 en: <a href="http://scielo.sld.cu/scielo.php?script=sci_arttext&pid=S1029-30192009000600016" >
                                    http://scielo.sld.cu/scielo.php?script=sci_arttext&pid=S1029-30192009000600016</a>
                            </p>
                            <p>
                                15. INEGI (2014). Encuesta Nacional sobre el uso del tiempo. Consultado el 15 de noviembre de 2014 en: <a href="http://www.inegi.org.mx/est/contenidos/proyectos/cn/tnrh/" target="blank">http://www.inegi.org.mx/est/contenidos/proyectos/cn/tnrh/</a>
                            </p>
                            <p>
                                16. Chihu-Ampar&aacute;n, A. (2002). <cite>Sociolog&iacute;a de la identidad.</cite> M&eacute;xico: Universidad Aut&oacute;noma
                                Metropolitana, Unidad Iztapalapa.
                            </p>
						</div>
					</div>
				</div>
				<div id="table2" class="tab-pane fade active in">
					<h2 class="text-center">Cuestionarios de contexto 2017</h2>
					<div id="projects" class="projects">
  					<h3 class="text-left"><b>Trabajo colaborativo</b></h3>
  					<p>
  						Esta dimensión indaga sobre aspectos relacionados con el aprendizaje en grupo, como menciona De la Parra y Gutiérrez
							“el trabajo cooperativo se define como un proceso de aprendizaje que enfatiza el grupo y los esfuerzos colaborativos entre
							profesores y estudiantes” (p. 5). Por su parte, Johnson 1993 (como se citó en De la Parra y Gutiérrez) plantea que
							“en el aprendizaje colaborativo cada miembro de grupo es responsable de su propio aprendizaje, así como el de los
							restantes miembros del grupo” (p. 5).  Por eso, la importancia de que los docentes sean capaces de crear ambientes de
							aprendizaje y fomenten el trabajo colaborativo con empatía y respeto (SEP Modelo educativo, 2017).
  					</p>
  					<h4 class="text-left"><b><i>Ambiente socio-afectivo</i></b></h4>
  					<p>
  					   El Modelo educativo (SEP 2017) establece que “el ambiente de aprendizaje es un conjunto de factores que favorecen o
							 dificultan la interacción social en un espacio físico o virtual determinado” (p. 82), por lo que, es relevante la
							 contribución del docente en ese espacio para crear un ambiente afectivo en el aula; por su parte,
							 Azcorra, Arias y Graff (2003) mencionan que “la posibilidad de que la escuela sea significada por el alumno como una
							 experiencia emocionalmente positiva va a depender en gran medida del ambiente que logren crear los alumnos y los
							 profesores en el contexto educacional” (p. 120). Aunado a lo anterior, resulta importante que las familias de los
							 niños participen en la escuela con los docentes y así contribuyan al logro de una comunidad de aprendizaje, que es
							 uno de los objetivos del Modelo educativo.
  					</p>
  					<h4 class="text-left"><b><i>Morosidad </i></b></h4>
            <p>
                El factor  morosidad  comprende  seis reactivos, la  sección hace referencia a dificultades que los alumnos pueden
								presentar al realizar sus tareas escolares y que puede asociarse al proceso de autorregulación, como falta de
								concentración, el cansancio, el nivel de dificultad  y el horario. Esta sección fue realizada considerando la escala
								de morosidad de Aguilar y Valencia (1995), quienes afirman que en el entorno educativo las consecuencias
								de esta morosidad son las bajas calificaciones y el abandono de cursos.
            </p>
            <h3 class="text-left"><b>Motivación</b></h3>
            <p>
            	De acuerdo con Jiménez y Macotela (2008), este factor se integra por “cinco dimensiones del aprendizaje en el
							salón de clases, que pueden ser caracterizadas por tener un polo de motivación intrínseco y otro extrínseco” p. 606.
							Por su parte, Schunk (como se citó en Jiménez y Macotela, 2008), menciona que “la motivación tiene un papel
							fundamental sobre el aprendizaje, ya que influye sobre lo que se aprende, cuándo y cómo se aprende” p. 601.
            </p>
						<p>
							De acuerdo con Harter, “los niños con motivación de eficacia muestran preferencia por el reto, trabajan para
							satisfacer su propia curiosidad, realizan intentos de dominio y muestran juicio independiente y criterios
							internos de éxito y fracaso” p. 602. Esta idea se asocia con la motivación intrínseca que se aborda en el
							factor de este cuestionario.
						</p>
						<p>
							Aunado a esto Ryan y Deci, (como se citaron en  Jiménez  y Macotela, 2008) señalan  “que cuando los niños están
							internamente motivados para lograr algo, pero intervienen presiones externas-como son las exigencias de sus padres,
							los exámenes o las calificaciones escolares- se esfuerzan pero presentan mayor ansiedad y pobre desempeño” p.603.
							En este  sentido, el Modelo educativo establece como función de la escuela el contribuir al desarrollo de la
							capacidad de aprender a aprender de los niños, niñas y jóvenes así como fomentar el interés y la motivación
							para aprender a lo largo de toda la vida (SEP 2017).
						</p>
						<p>
							Con base en lo anterior,  la tabla 1 detalla las dimensiones, los reactivos y el polo de motivación que
							corresponde a cada una. El contenido de los reactivos y las opciones  de respuesta permiten que los niños
							escojan  entre repuestas de motivación intrínseca o extrínseca.
						</p>
						<br />
						<p>Tabla 1. Dimensiones de Motivación</p>
						<table class="table table-striped table-condensed text-center">
							<thead>
								<tr class="success">
									<th colspan="3">Motivación</th>
									<th>Reactivos</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center">
									<td >
										<b>Motivación extrínseca</b>
									</td>
									<td ></td>
									<td >
										<b>Motivación intrínseca</b>
									</td>
									<td >
									</td>
								</tr>
									<td class="text-left">
										Dimensión 1. Dependencia hacia el maestro
									</td>
									<td class="text-left">
									Vs.</td>
									<td class="text-left">
										Independencia
									</td>
									<td >
										3
									</td>
								</tr>
								<tr>
									<td class="text-left">
										Dimensión 2. Obtener calificaciones
									</td>
									<td class="text-left">
									Vs.</td>
									<td class="text-left">
										 Interés por aprender
									</td>
									<td >
										3
									</td>
								</tr>
								<tr>
									<td class="text-left">
										Dimensión 3. Preferencia por el trabajo fácil
									</td>
									<td class="text-left">
									Vs.</td>
									<td class="text-left">
										Preferencia por el reto
									</td>
									<td >
										4
									</td>
								</tr>
								<tr>
									<td class="text-left">
										Dimensión 4. Dependencia hacia el juicio del maestro
									</td>
									<td class="text-left">
									Vs.</td>
									<td class="text-left">
										Juicio independiente
									</td>
									<td >
										5
									</td>
								</tr>
								<tr>
									<td class="text-left">
										Dimensión 5. Obediencia a la demanda escolar
									</td>
									<td class="text-left">
									Vs.</td>
									<td class="text-left">
										Seguir intereses personales
									</td>
									<td >
										4
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a class="go-top" href="#">Subir</a>
			<script src="imports/js/buttonTop.js"></script>
		</div>
		<!-- /container -->
		<?php
        include ('footer.php');
		?>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
		<script>
			var onResize = function() {
				// apply dynamic padding at the top of the body according to the fixed navbar height
				$("body").css("padding-top", $(".navbar-fixed-top").height());
			};

			// attach the function to the window resize event
			$(window).resize(onResize);

			// call it also when the page is ready after load or reload
			$(function() {
				onResize();
			});
		</script>
	</body>
</html>
