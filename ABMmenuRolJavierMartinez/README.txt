Expliación práctica ABM en PHP por Javier Martínez:

He estado trabajando en una aplicación muy parecida a la creada en clase sobre la agenda,
ya que todo lo que se lo he aprendido trabajando sobre agenda.
Mi práctica consta de 3 tablas: 
Región(con un id y un nombre al igual que Categoría en agenda).
Personaje(se asemeja a Persona, tiene un par de selects predefinidos con arrays, y está asociada
a Región, cada personaje es de una región).
Equipo(Contiene equipación: arma, magia, armadura. Cada equipo pertenece a un personaje)
Las 3 tablas están asociadas en cascada.

Sus funcionalidades son las más avanzadas de la Agenda:

-Podemos ver los personajes que pertenecen a una Región.
-Al igual, podemos ver los distintos equipos que tenemos creados para un personaje.
-Hay sección de favoritos en personajes como en equipos, activando y desactivando 
con un click en el icono.
-Se puede filtrar por favoritos y se mantiene gracias a variables SESSION
-Se nos muestra en fondo amarillo al crear o modificar, el personaje o equipo que hemos manipulado.
-Al hacer un alta, baja o modificación se nos informa en la págigna del listado, es decir,
se hace un redireccionamiento inmediato con header desde el ficheroEliminar.php 
