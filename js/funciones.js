 <script >
        function delete_alumnos(id_to_delete) {

          var confirmation = confirm('¿Está seguro de que desea eliminar el estudiante con el número de control '+ id_to_delete);
    
          if(confirmation)
          {
            window.location = "delete_alumnos.php?No_control="+id_to_delete;
          }
        }

        function delete_actividad(id_activadad){

          var confirmation = confirm('¿Está seguro de que desea eliminar la actividad con clave '+ id_activadad);

          if (confirmation) {

            window.location = "delete_actividad.php?clave_act=" + id_activadad;
          }
        }

        function delete_carrera(id_carrera) {

          var confirmation = confirm('¿Está seguro de que desea eliminar la carrera con clave ' + id_carrera);

          if (confirmation) {

            window.location = "delete_carrera.php?clave_carrera=" + id_carrera;
          }
        }
    
      function delete_depe(id_deper){

          var confirmation = confirm('¿Está seguro de que desea eliminar el departamento? ' + id_deper);

          if (confirmation) {

            window.location = "delete_departamento.php?rfc_departamento=" + id_deper;
          }
      }

      function delete_insti(id_inst){

          var confirmation = confirm('¿Está seguro de que desea eliminar el instituto con clave ' + id_inst + ' ?');

          if (confirmation) {

            window.location = "delete_instituto.php?clave_instituto=" + id_inst;
          }
      }

      function delete_instruc(id_depe){

          var confirmation = confirm('¿Está seguro de que desea eliminar el instructor ' + id_depe);

          if (confirmation) {

            window.location = "delete_instructor.php?rfc_instructor=" + id_depe;
          }
      }
      
      

      function delete_tra(id_tr){

          var confirmation = confirm('¿Está seguro de que desea eliminar el trabajador ' + id_tr);

          if (confirmation) {

            window.location = "delete_trabajador.php?rfc_trabajador=" + id_tr;
          }
      }

       function delete_solicitud(id_solicitud){

          var confirmation = confirm('¿Está seguro de que desea eliminar la solicitud ' + id_solicitud);

          if (confirmation) {

            window.location = "delete_solicitud.php?folio=" + id_solicitud;
          }
      }


  </script>

  <script>
  
    function mostrar(id) {

       if (id == "Seleccion") {
        $("#es").show();
        $("#insertar").hide();
        $("#buscar").hide();
      }
      
      if (id == "insertar") {
        $("#insertar").show();
        $("#buscar").hide();
        $("#es").hide();
      }
      
        
      if (id == "buscar") {
       $("#insertar").hide();
        $("#buscar").show();
        $("#es").hide();
      }
    }
  </script>