<!DOCTYPE html>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
  <head>
    <title>{$p_title|default:"Credit calculator"}</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, user-scalable=no"
    />
    <meta name="description" content="{$p_description|default:"Credit calculator"}">
    <link rel="stylesheet" href="{$config->app_url}/assets/css/main.css" />
    <link rel="stylesheet" href="{$config->app_url}/assets/css/style.css" />
    <noscript
      ><link rel="stylesheet" href="{$config->app_url}/assets/css/noscript.css"
    /></noscript>
  </head>
  <body class="is-preload {if !$hide_hero|default:true}landing{/if}">
    <div id="page-wrapper">
      <!-- Header -->
      <header id="header">
        <h1 id="logo"><a href="{$config->app_url}">Credit calculator</a></h1>
        <nav id="nav">
        {strip}
          <ul>
            {if isset($user)}
              <li><b>Welcome {$user->login}. Role: {$user->role}</b></li>
              <li><a href="{$config->action_url}credit_calc">Home</a></li>
              <li><a href="{$config->action_url}protected_page">Protected page</a></li>
              <li><a href="{$config->action_url}logout" class="button primary">Logout</a></li>
            {else}
              <li><a href="{$config->action_url}login" class="button primary">Sign Up</a></li>
            {/if}
          </ul>
        {/strip}
        </nav>
      </header>
      {block name=hero}{/block}
      <!-- Main -->
      <div id="main" class="wrapper style1">
        <div class="container">
            <header class="major">
              <h2>{$p_major_title}</h2>
              {if $p_major_description|default:false}
                <p>{$p_major_description}</p>
              {/if}
            </header>
            <section>
              {block name=main}{/block}
            </section>
        </div>
      </div>

      <!-- Footer -->
      <footer id="footer">
        <ul class="icons">
          <li>
            <a
              href="https://github.com/dominikjalowiecki"
              class="icon brands fa-github"
            >
              <span class="label">GitHub</span>
            </a>
          </li>
          <li>
            <a
              href="mailto:{'dominikjalowiecki1@gmail.com'|escape:'hex'}"
              class="icon solid fa-envelope"
            >
              <span class="label">Email</span>
            </a>
          </li>
        </ul>
        <ul class="copyright">
          <li>&copy; Dominik Jałowiecki. All rights reserved.</li>
          <li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
        </ul>
      </footer>
    </div>

    <!-- Scripts -->
    <script src="{$config->app_url}/assets/js/jquery.min.js"></script>
    <script src="{$config->app_url}/assets/js/jquery.scrolly.min.js"></script>
    <script src="{$config->app_url}/assets/js/jquery.dropotron.min.js"></script>
    <script src="{$config->app_url}/assets/js/jquery.scrollex.min.js"></script>
    <script src="{$config->app_url}/assets/js/browser.min.js"></script>
    <script src="{$config->app_url}/assets/js/breakpoints.min.js"></script>
    <script src="{$config->app_url}/assets/js/util.js"></script>
    <script src="{$config->app_url}/assets/js/main.js"></script>
  </body>
</html>