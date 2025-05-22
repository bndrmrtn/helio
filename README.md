# Helio Todo App

This is a simple Todo App built with Laravel and Vue.js.

## My work

### I created a Todo model with a migration via this command:

```shell
php artisan make:model Todo -m
```

`-m` means via a migration file.

### I created a Todo Controller

Within the mentioned controller I created several functions that handles the
incoming requests. Each function has a route registered in the `routes/web.php`.

### I also created a TodoRequest to handle the create or update requests

Creating a request is important to make the core Todo controller clean
without tons of validations.

## The frontend

I utilized Vue.js for the frontend. Laravel provides Interia.js which is a
wrapper to connect the frontend and the backend without writing my own `fetch(...)` function.
It handles all the credential things, CORS, and everything else.

### Pages

I modified the default laravel template code in the `resources/js` folder. I
added a really simple page layout for all my pages. Then I created a vue script
to display all the Todos and a simple pagination at the bottom.
I also created a custom component `TodoForm.vue` for creating and editing Todos
in the same component. This helped me to do not repeat myself with the form and
handle everything in a single file. Then I used it without the `Create.vue` and
in the `Edit.vue` also.
I also created a simple script for validating the user input in the frontend, but
I also made sure that the Laravel application itself does not allow bad values,
making it safer. Vue comes with built-in XSS prevention which I knew, so I did not
add `htmlspecialchars(...)` or something similar.

## Summary

The project itself wasn't too hard. The only problem I had is I had to work
on a new computer and setting up Vite was a pain, but since AI is allowed I used it
to help me find that I had to run `Set-ExecutionPolicy RemoteSigned` in my PowerShell
to even allow `npm install`. After solving that problem I faced another issue
that was solved by a ChatGPT suggested command: `npm uninstall lucide-vue-next` 
and then an `npm install`.
