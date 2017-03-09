    
<html><head>
  <meta charset="utf-8">
  <title>Salary Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
<link rel="stylesheet" type="text/css" href="css/templateblue.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="row">
    <div class="col-md-1"></div>
    
    <div class="col-md-5">
    <table class="table table-hover" id="resourcing" width="auto"><tbody><tr><th>ID</th><th>Name</th><th>Start Date</th><th>End Date</th><th>Description</th><th>Status</th></tr><tr class="clickableRow" href="#" onclick="openUser(1);"><td>1</td><input type="hidden" name="id" size="9" value="1"><td>Ajay12</td><td>14-04-2016</td><td>15-01-2016</td><td>We are Finennnn</td><td>Open</td></tr><tr class="clickableRow" href="#" onclick="openUser(2);"><td>2</td><input type="hidden" name="id" size="9" value="2"><td>Shinu</td><td>09-12-2016</td><td>29-01-2016</td><td>okokokok11</td><td>InProgress</td></tr></tbody></table>
</div>
    <div class="col-md-5">
    <table class="table table-hover" id="resourcing" width="auto"><tbody><tr><th>ID</th><th>Name</th><th>Start Date</th><th>End Date</th><th>Description</th><th>Status</th></tr><tr class="clickableRow" href="#" onclick="openUser(1);"><td>1</td><input type="hidden" name="id" size="9" value="1"><td>Ajay12</td><td>14-04-2016</td><td>15-01-2016</td><td>We are Finennnn</td><td>Open</td></tr><tr class="clickableRow" href="#" onclick="openUser(2);"><td>2</td><input type="hidden" name="id" size="9" value="2"><td>Shinu</td><td>09-12-2016</td><td>29-01-2016</td><td>okokokok11</td><td>InProgress</td></tr></tbody></table>
<button class="btn btn-primary" type="submit">Button</button>
    </div>
   <div class="col-md-5">  <img src="images/lion.jpeg" class="img-responsive" alt="Responsive image">
       </div>   
    <div class="col-md-5">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul></div>

</body>
</html>



 <div class="tabbable" id="tabs-344382">
    <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            Home</a></li>
    <li role="presentation">
        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            Resourcing</a></li>
    <li role="presentation">
        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
            Messages</a></li>
    <li role="presentation">
        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
            Settings</a></li>
  </ul>
    
    <div class="tab-content">
    <div class="tab-pane active" id="home">
            <p>
                    I'm i 1.
            </p>
    </div>
    <div class="tab-pane" id="profile">
            <p>
                    
            </p>
    </div>
           <div class="tab-pane" id="messages">
            <p>
                all is well
            </p>
    </div>
        </div></div>
<a id="modal-937122" href="#modal-container-937122" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
   <div class="modal fade" id="modal-container-937122" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" contenteditable="true">Modal title</h4>
      </div>
      <div class="modal-body" contenteditable="true">
      <?php echo input_new("resourcing"," id=2",$field_edit,$field_show,3); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" contenteditable="true">Close</button>
        <button type="button" class="btn btn-primary" contenteditable="true">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>