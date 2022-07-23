---
layout: post
title: "Learning Laravel: Assets and Authentication"
date: 2022-07-23
---

# Learning Laravel Series
This is a series designed to show off various features of the Laravel framework in fun, easily consumable projects. 
I’ll be keeping track of the entire series in my public [GitHub repo](https://github.com/krievley/learning-laravel) and 
including the instructions for keeping your own project up to date with mine. For fun, I decided to create these 
projects around the theme of Carmen Sandiego, an international thief who has appeared in video games and television 
shows since 1985.

## Intro
Carmen needs a web application to assist in her life of crime. She needs the application to have authentication and fit 
with her current brand.

## Real World Application
Almost every web application requires authentication and custom styling. We are going to take a look at Laravel’s 
starter kits, and creating a custom theme with Tailwind CSS.

## Getting Started
Make sure you have a local environment setup to run a Laravel application by following the [documentation](https://laravel.com/docs/9.x/installation#your-first-laravel-project).
Fork the [learning-laravel](https://github.com/krievley/learning-laravel) repository and check out the 
[assets-and-authentication__start](https://github.com/krievley/learning-laravel/tree/assets-and-authentication__start) branch locally.
Then, follow the installation instructions in the README.

This branch includes:
- A new Laravel project.
- Client Logo

## Tailwind CSS Setup
We will install Tailwind CSS using the [documentation](https://tailwindcss.com/docs/guides/laravel) specific to installing in a Laravel project. 
Skip step one since we already have a new Laravel project. Install and initialize the config file by running: 
`npm install -D tailwindcss postcss autoprefixer && npx tailwindcss init -p`. 
There should be two new files in the base of your project. Open up `tailwind.config.js` and modify the content setting 
by following the documentation.

```tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
```

Finally, open the `resources/css/app.css` file and add the `@template` directives from the documentation.

```app.css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

You should now be able to run `npm run dev` with no error output.

## Laravel Breeze
This will require you to have a database setup on your local development environment. For more information, checkout 
Laravel’s installation documentation on [databases and migrations](https://laravel.com/docs/9.x/installation#databases-and-migrations).

Laravel provides two authentication [starter kits](https://laravel.com/docs/9.x/starter-kits#laravel-breeze): Breeze and Jetstream. 
On this project, we are going to use the Breeze & Blade configuration. Install `laravel/breeze` composer package as a “dev” dependency by running: 
`composer require laravel/breeze --dev`. 

> **Why is this a “dev” dependency?** 
>
> The package generates the authentication scaffolding, which isn’t necessary for the application to run in a production environment.

Once the package is installed we will use its artisan command to install all the assets we need to the project: 
`php artisan breeze:install`. After the scaffolding is finished installing, we need to build the assets using NPM: 
`npm install && npm run dev`. The last step is to run the migrations that Breeze created for us: `php artisan migrate`.

With `vite` running, you should be able to access the `/login` route after running `php artisan serve`.

## Blade Templates
At this point, we have a Laravel application with authentication and Tailwind CSS. It’s time to update the default 
Laravel styles, with styles and images that match our client’s brand. Laravel utilizes a templating language called 
[Blade](https://laravel.com/docs/9.x/blade) to render web pages with PHP. Blade will help us to write modular and 
reusable code using templates and components. Since we want our base CSS and Javascript files to be included on every 
page, let’s create a new template file in `resources/views/layouts` called `base.blade.php`. We'll start out by copying 
over the contents of the `app.blade.php` template file. 

> **Why are we creating a new template instead of modifying this one?**
>
> By default the `app.blade.php` template file is used for all pages that are accessed by authenticated users. 
> The `guest.blade.php` template file is used for all pages that are accessed by non authenticated users or “guests”. 
> If you look at both of them, you will see duplicate code that we are going to abstract into a “base” template that 
> these two existing templates will extend.

Inside the `<head>` tag you should see an import for a Google font named “Nunito”. Carmen’s brand guidelines are to 
use “Oswald” for headings and “Lato” for body text, so we will replace the current import with the following:

```
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel=“stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
```

We will then update the `<body>` tag with a Blade parameter that will accept content supplied to the template utilizing 
[template inheritance](https://laravel.com/docs/9.x/blade#layouts-using-template-inheritance).

```
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', ‘Learning Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @yield('body')
</body>
</html>
```

We will then update the `app.blade.php` and `guest.blade.php` template files to extend the new `base.blade.php` template.

```
@extends('layouts.base')

@section('body')
	// Place the contents of the <body> tag from each template file.
@endsection
```

## Welcome Page
The default `welcome.blade.php` page doesn't utilize a template file by default and loads its own custom styles. 
Let's change that by extending the base layout just like we did in the `app` and `guest` layout files. 
Then we’ll update the body content with a page heading and links to the authentication routes.

```
@extends('layouts.base')

@section('body')
    <div class="container mx-auto">
        <div class="h-screen flex justify-center items-center">
            <div>
                <h1 class="text-7xl text-center">Ready Player?</h1>
                <div class="my-5 grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                    <a href="/login" class="text-center">Log In</a>
                    <a href="/register" class="text-center">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
@endsection
```

## Tailwind Theme
All of our pages are now extending our base layout, and loading the fonts for our client’s brand. To start working 
with these fonts, we will need to modify the [Tailwind theme](https://tailwindcss.com/docs/theme). Tailwind has default 
theme settings for fonts that we can extend to apply our loaded fonts correctly. In order to apply the font “Oswald” to 
heading tags, we extend the font setting named “display”. To apply the font “Lato” to all body content, we extend the 
setting “sans”.

```
// tailwind.config.js
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                'display': ['Oswald', 'sans-serif'],
                'sans': ['Lato', 'sans-serif'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
```

The `layouts/base.blade.php` file already applies the `font-sans` class to the body tag, but we need to update our 
`app.css` file to apply the `font-display` class to all heading tags.

```
// app.css
@tailwind base;
@tailwind components;
@tailwind utilities;

h1, h2, h3, h4, h5, h6 {
    @apply font-display;
}
```

The `tailwind.config.js` will also accept custom colors and generate classes that we can apply to our pages without 
needing to write extra CSS code. Carmen provided us with her logo, and it has been added to the project at 
`public/img/carmen_logo.png`. We can use a color picker on this image to get the brand color `#BF201D`. 
To generate complimentary colors for the site, I like to use [colormind.io](colormind.io). Colormind can generate an all 
new color palette, or generate a palette based on provided color values. We’ll take the colors that were generated 
from Colormind and put them in our Tailwind config file.

```
// tailwind.config.js
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        colors: {
            brand: '#bf201d',
            brandHover: '#991B1B',
            light: '#f4f2f1',
            lightAccent: '#d67621',
            lightAccentHover: '#b5631b',
            dark: '#34283e',
            darkAccent: '#b58b7f',
            darkAccentHover: '#d6a496',
            primary: '#bf201d',
            info: '#33283e',
            success: '#6f8441',
            warning: '#ec7409',
            danger: '#f44336',
            disabled: '#d2d2d2',
        },
        extend: {
            fontFamily: {
                'display': ['Oswald', 'sans-serif'],
                'sans': ['Lato', 'sans-serif'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
```

After adding the color values to Tailwind and recompiling our assets, we can start using Tailwind classes to customize 
the existing pages. Let’s start by opening the `layouts/base.blade.php` file and adding a background color and 
text color all pages will inherit. With Tailwind all we have to do is add a few classes to the `<body>` tag.

```
<body class="font-sans antialiased bg-light text-dark">
```

## Blade Components
Breeze installed Blade components for use on the authentication pages which you can find at 
`resources/views/components`. We can modify a component named `application-logo` to load the client’s logo on all the 
existing Breeze authentication pages.

```
// application-logo.blade.php
<img alt=“Logo" src="{{ asset('img/carmen_logo.png') }}”  {{ $attributes }} />

```  

## Keep Going
We have worked through the process of setting up a new Laravel application with authentication and brand assets. 
Take this opportunity to create and modify the current views and components to really make this site your own. 
If you would like to take a look at my version, check out [assets-and-authentication__end](https://github.com/krievley/learning-laravel/tree/assets-and-authentication__end).

Stay tuned for Carmen’s next assignment.

echo "source $(brew --prefix)/opt/chruby/share/chruby/chruby.sh" >> ~/.bash_profile
echo "source $(brew --prefix)/opt/chruby/share/chruby/auto.sh" >> ~/.bash_profile
echo "chruby ruby-3.1.2" >> ~/.bash_profile # run 'chruby' to see actual version
