<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>toDoList</title>
    <!-- Bootstarp CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
      .scrollbar{
      height:300px;
      overflow-y:scroll; 
    }
    </style>
    
  </head>
  <body>

    <div class="container-fluid  bg-light my-1">
      <div class="row justify-content-center">
        <div class="text-center my-1">
          <div class="display-4">List of Tasks</div>
        </div>
        <div class="col-lg-6 ">
          <ul class="list-group mb-3 scrollbar" id="taskLists"></ul>
        </div>
      </div>
    </div>

      <div class="container my-2">
        <div class="row justify-content-center">
          <form class="col-lg-6 d-grid">
              <div class="my-2">
                <label for="task" class="form-label">Enter any Task</label>
                <textarea type="text" class="form-control" id="task" name="task" aria-describedby="task" rows="3"></textarea>
                
              </div>
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" id="finished">
                <label class="form-check-label" for="finished">finished</label>
              </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary mt-2">Submit</button>
          </form>
        </div>
      </div>
    
    <script>
      function getTaskName(element){
        const name=element.slice(0,element.length-1);
        const finished=element[element.length-1];
        return [name,finished];
      }
      function getTask(){
          $.get("load.php",function(data,status){
          const responseArray=data.split(',');
          let output="",name,finished;
          for (let task of responseArray) {
            [name,finished]=getTaskName(task);
             finished=Number(finished)==1?"text-decoration-line-through'":"'";
            
            output+="<li class='list-group-item text-center "+finished+">"+name+"</li>";
          }
          $("#taskLists").html(output);
        });
      }

      $(document).ready(function () {
        // load the tasks into the list
        getTask()

        // save the task into the database
        let nameTask, finished;
        $("#submit").click(function (e) {
          e.preventDefault();
          nameTask = $("#task").val();
          finished = $("#finished").is(":checked") ? 1 : 0;
          $.get(
            "save.php?task=" + nameTask + "&finished=" + finished,
            function (data, status) {
              getTask();
            }
          );
        });
      });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
