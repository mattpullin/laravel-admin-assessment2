
Assessment 2 – laravel admin assessment 2

GitHub repository: https://github.com/mattpullin/laravel-admin-assessment2

Approach

I started with the provided template and reviewed it to see what was included.  I then set up a new GitHub repo so i could commit after each major stage. I ran the composer and php artisan ui commands, keeping the template's existing layout and views, then icreated the MySQL database with the required naming format. I then configured the .env, ran migrations and seeded the two users, admin and user. 

I proceeded to then build out the category model, migration, factory and seeder before the post, this was because posts has a foreign key to categories and the migrations run in timestamp order. I used foreign key constraints on the user_id and category_id rather than plain integers, so the relationships exist at the database level. I then defined the relationships in the models, Post belongsTo Category and User, Category hasMany Posts. I created dedicated CategorySeeder and PostSeeder classes called from DatabaseSeeder as i missed this in asessment 1, i then seeded the 5 categories and 10 posts with random categories. I then restricted the login to admin only by overriding the credentials in the LoginController so that admin is part of the login check, this meant that user@example.com fails authentication. I set up the admin route group with the admin prefix and authorised the middleware covering both post and category CRUD routes so the redirected correctly.


I used route model binding to post and cagtegory instead of manual findOrFail lookups so that Laravel automatically looks up the model and handles missing IDs with a error 404, this elimatates repetitive lookup and then added a custom 404 page on the fallback route so that invalid IDs route to the same page. I built both CRUDs, posts and categories,  using a shared form partial for each, so the create and edit views reuse the same fields. The post form includes a category dropdown to set its category, the posts list displays each post's category name, and the categories list shows a post count per category.

I Used eager loading on the posts list to avoid N+1 queries, the posts index displays each post's category and author, so without eager loading every row would trigger two extra queries. Using with('category', 'user') loads all posts, categories and users into a query to form an array regardless on the list size.

Testing 

I then completed feature tests to ensure guest redirect, non-admin rejection, posts list, post creation with category, custom 404, and the admin redirect were functioning correctly. I then formatted with Laravel Pint and manually tested the full CRUD loop as admin


Challenges

My first git remote add had a typo in the GitHub username, so pushes failed with repository not found. I fixed it with git remote set-url.

A missing use Illuminate\Http\Request import in the LoginController caused a TypeError on login i learned how PHP resolves un-imported class names to the current namespace and added the required use Illuminate\Http\Request to resolve it.

Blade view files ended up at the wrong folder level since both CRUDs use the same four filenames, one set overwrote the other, reviewed how viewposts.index maps to folders, and rebuilt the structure as parallel posts,categories and folders.

One of the rebuilt files accidentally contained two templates pasted together, causing an undefined variable error, using the error's line number i chased down the code and corrected it.

Assessment 1 issue of of edits not reaching the disk resolved by enabling autosave at the beginning of the project. I still used the verification tools Get-Content, Get-ChildItem, Select-String as diagnostic aids but didnt have to rely on them as much with save input occurring automatically.

 I Used AI as a development aid in this assessment with all work reviewed, implemented and tested myself.