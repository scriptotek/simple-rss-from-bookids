(function () {
	
	function MainCtrl($http) {
        var vm = this;

        // this is the link to the google api we will use to load our rss feed
        // into json
        var googleApiURL = 'http://ajax.googleapis.com/ajax/services/feed/load';

        // holder for the rss data we already have
        vm.googleApiResult = {};

        // this will hold the url the user wants to load from
        vm.feedUrl = 'http://www.ub.uio.no/fag/naturvitenskap-teknologi/astro/nyinnkjop/nyetrykteboker.rss';
        vm.description = null;
        vm.link = null;
        vm.title = null;
        vm.entries = [];

        vm.test = function() {
        	console.log('test');
        };

        vm.loadFeed = function() {

        	console.log('Trying to load data from feed..');
	    	
	    	$http.jsonp(googleApiURL, {
				method: 'GET',
				params: {
					v: '1.0',
					q: vm.feedUrl,
					callback: 'JSON_CALLBACK'
				}
			})
			.success(function(data) {
				console.log('Data loaded from feed:')
				vm.googleApiResult = data.responseData.feed;
				console.log(vm.googleApiResult);

				vm.feedUrl = vm.googleApiResult.feedUrl;
				vm.description = vm.googleApiResult.description;
				vm.link = vm.googleApiResult.link;
				vm.title = vm.googleApiResult.title;
				vm.entries = vm.entries.concat(vm.googleApiResult.entries);

                vm.generateFeed();
			})
			.error(function(err) {
				console.log('Unable to load data from feed:')
				console.log(err);
			});
        };

        // when user wants to add a new entry then the id will be stored here
        vm.bookId = '132038137';

        vm.addNew = function() {
        	console.log('Trying to add a new entry: ' + vm.bookId);
            $http.get('http://katapi.biblionaut.net/documents/show/' + vm.bookId + '?format=json')
            .success(function(data) {

                console.log('We have found info about this bookid:');
                console.log(data);
                console.log('Going to create a new entry for this book..');

                var newEntry = {};
                newEntry.title = data.title;
                newEntry.description = data.description;
                newEntry.link = 'http://ask.bibsys.no/ask/action/show?kid=biblio&cmd=reload&pid=' + vm.bookId;
                // add this new entry:
                vm.entries.splice(0, 0, newEntry);

                console.log('New entry added!');

                vm.generateFeed();

            })
            .error(function(err) {
                console.log('Error in addNew');
            });
        };

        // this variable will hold the rss when returnes
        vm.rss = null;

        vm.generateFeed = function() {

        	console.log('Trying to generate feed.');
            vm.rss = 'Generating...';

            var postData = {
                title: vm.title,
                description: vm.description,
                link: vm.link,
                entries: vm.entries
            };

        	$http({
        		url: 'generator.php',
        		method: 'POST',
        		params: {
    				data: postData
    			},
        		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        	})
        	.success(function(data) {
        		console.log('Data returned from generator.php:');
        		console.log(data);
        		vm.rss = data;
        	})
        	.error(function(err) {
				console.log('Unable to load data from feed:')
				console.log(err);
        	});

        }

        return vm;
	}

	// create app and add controller
	angular.module('rssApp', [])
	.controller('MainCtrl', MainCtrl);

})();