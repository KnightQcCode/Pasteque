

    <!-- Si on est pas sur la première page et s'il y a plus d'une page -->
    @if ($numeroPage > 0)
        <a href="{!! $urlPagination . "&page=" . 0  !!}" class="boutonAction__lien">
            <div class="boutonAction">
               <i class="premier fas fa-angle-double-left fa-2x"></i>
            </div>
        </a>
    @else
        <div class="boutonAction--desactiver">
            <span style="color:#B9A1A1"><i class="fas fa-angle-double-left fa-2x"></i></span> <!-- Bouton premier inactif -->
        </div>
    @endif


    @if ($numeroPage > 0)
        <a href="{!! $urlPagination . "&page=" . (htmlspecialchars($numeroPage) - 1) !!}" class="boutonAction__lien">
            <div class="boutonAction">
                <i class="precedent fas fa-angle-left fa-2x"></i>
            </div>
        </a>
    @else
        <div class="boutonAction--desactiver">
            <span style="color:#B9A1A1"><i class="fas fa-angle-left fa-2x"></i></span><!-- Bouton précédent inactif -->
        </div>
    @endif

<div class="progressionPage">
    <!-- Statut de progression: page 9 de 99 -->
    <span>{{"Page " . ($numeroPage + 1) . " de " . ($nombreTotalPages + 1)}}</span>
</div>


    <!-- Si on est pas sur la dernière page et s'il y a plus d'une page -->
    @if ($numeroPage < $nombreTotalPages)
        <a href="{!! $urlPagination . "&page=" . (htmlspecialchars($numeroPage) + 1)  !!}" class="boutonAction__lien">
            <div class="boutonAction">
                <i class="suivant fas fa-angle-right fa-2x"></i>
            </div>
        </a>
    @else
        <div class="boutonAction--desactiver">
            <span style="color:#B9A1A1"><i class="fas fa-angle-right fa-2x"></i></span><!-- Bouton suivant inactif -->
        </div>
    @endif

    @if ($numeroPage < $nombreTotalPages)
        <a href="{!! $urlPagination . "&page=" . htmlspecialchars($nombreTotalPages) !!}" class="boutonAction__lien">
            <div class="boutonAction">
                <i class="dernier fas fa-angle-double-right fa-2x"></i>
            </div>
        </a>
    @else
        <div class="boutonAction--desactiver">
            <span style="color:#B9A1A1"><i class="fas fa-angle-double-right fa-2x"></i></span><!-- Bouton dernier inactif -->
        </div>
    @endif



