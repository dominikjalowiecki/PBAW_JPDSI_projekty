{extends file="./_base.tpl"}

{block name=hero}
  {if !$hide_hero}
    <section id="hero" class="spotlight style1 bottom">
      <span class="image fit main">
        <img src="{$config->app_url}/assets/images/pexels-pixabay-53621.webp" alt="Image shows calculator, pencil and calculations."/>
      </span>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-6 col-12-medium">
              <header>
                <h2>Credit calculator</h2>
                <p>Calculate credit interest within seconds.</p>
              </header>
            </div>
          </div>
        </div>
      </div>
      <a href="#main" class="goto-next scrolly">Next</a>
    </section>
  {/if}
{/block}
