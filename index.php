<?php

if (isset($_GET['feed'])) {

}

?>

<!DOCTYPE html>
<html lang="en" ng-app="rssApp">
<head>
	<meta charset="UTF-8">
	<title>RSS</title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.21/angular.min.js"></script>
	<script src="app.js"></script>
</head>
<body ng-controller="MainCtrl as MainCtrl">

	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">RSS</a>
			</div>
		</div>
	</nav>

	<div class="container">

		<div>
			<h3>Load from existing feed?</h3>
			<form ng-submit="MainCtrl.loadFeed()" name="loadForm">
				<div class="form-group">
					<label for="feedurl">Feed URL</label>
					<input type="text"
						name="feedurl"
						ng-model="MainCtrl.feedUrl"
						class="form-control input-lg"
						placeholder="Enter feed URL">
				</div>
				<div class="form-group text-right">
					<button
						class="btn btn-primary btn-lg">
						Load
					</button>
				</div>
			</form>
		</div>

		<div>
			<h3>Information about your feed:</h3>
			<form>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text"
						name="title"
						ng-model="MainCtrl.title"
						class="form-control"
						placeholder="Enter feed title">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text"
						name="description"
						ng-model="MainCtrl.description"
						class="form-control"
						placeholder="Enter feed description">
				</div>
				<div class="form-group">
					<label for="link">Link</label>
					<input type="text"
						name="link"
						ng-model="MainCtrl.link"
						class="form-control"
						placeholder="Enter feed link">
				</div>
			</form>
		</div>

		<div>
			<h3>Add new entry:</h3>
			<form ng-submit="MainCtrl.addNew()" name="addForm">
				<div class="form-group">
					<label for="bookId">Book ID:</label>
					<input type="text"
						name="bookId"
						ng-model="MainCtrl.bookId"
						class="form-control input-lg"
						placeholder="Enter feed URL">
				</div>
				<div class="form-group text-right">
					<button
						class="btn btn-primary btn-lg">
						Add
					</button>
				</div>
			</form>
		</div>

		<div ng-show="MainCtrl.entries.length>0">
			<h3>Entries in feed:</h3>
			<ul>
				<li ng-repeat="entry in MainCtrl.entries">
					<h4>{{ entry.title }} <small>{{ entry.publishedDate }}</small></h4>
					<p>{{ entry.link }}</p>
				</li>
			</ul>
		</div>

		<div ng-show="MainCtrl.entries.length>0">
			<h3>Generate feed?</h3>
			<form ng-submit="MainCtrl.generateFeed()" name="generateFeedForm">
				<div class="form-group">
					<button
						class="btn btn-primary btn-lg">
						Generate
					</button>
				</div>
			</form>
		</div>

		<div ng-show="MainCtrl.rss">
			<textarea
				class="form-control"
				rows="50"
				ng-model="MainCtrl.rss">
				
			</textarea>
		</div>
		
	</div>

</body>
</html>