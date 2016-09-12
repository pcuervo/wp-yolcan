<?php global $current_user;
global $opCliente;
global $clubCanasta; ?>
<article class="[ padding--bottom margin-bottom ]">
	<h4>Tu cuenta</h4>
    <p>
        <?php echo "Tu saldo es de <strong>$ ".$opCliente->saldo." </strong>"; ?>
    </p>
    <?php if ($opCliente->suspendido != 1 AND $opCliente->saldo != 0): ?>
        <p>Fecha próximo corte: <strong> <?php echo getDateTransform(getProximoCorte()); ?></strong></p>
     <?php endif ?>
	<a href="<?php echo site_url('nuestros-productos/'); ?>" class="[ btn btn-secondary btn-small ]">agrega saldo a tu cuenta</a>

</article>

<?php if ($opCliente->saldo != 0): ?>
    
    <!-- SUSPENDER ENTREGAS - FALTA INTEGRAR -->
    <article class="[ padding--bottom border-bottom margin-bottom ]">
        <?php if ($opCliente->suspendido != 1): ?>
        	<p>Desea <strong>suspender</strong> sus entregas?</p>

            <form method="post" id="contactus_form" action="">
                <div class="[ margin-bottom--small ]">
                    <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1" checked>
                    <label for="suspender-1"><span class="[ margin-right--xxsmall ]"></span>1 Semana</label>
                </div>
                <div class="[ margin-bottom--small ]">
                    <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2">
                    <label for="suspender-2"><span class="[ margin-right--xxsmall ]"></span>2 Semanas</label>
                </div>
                <div class="[ margin-bottom--small ]">
                    <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3">
                    <label for="suspender-3"><span class="[ margin-right--xxsmall ]"></span>3 Semanas</label>
                </div>
                <div class="[ margin-bottom--small ]">
                    <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4">
                    <label for="suspender-4"><span class="[ margin-right--xxsmall ]"></span>4 Semanas</label>
                </div>
                <input type="hidden" name="action" value="suspender-canasta">
                <input type="submit" name="enviar" id="submit" class="[ btn btn-secondary btn-small ][ margin-bottom ]" value="suspender entrega"/>
            </form>
        <?php endif;
        if ($opCliente->suspendido == 1):
            $suspension = $clubCanasta->suspension; ?>
            <p>Tus entregas estan suspendidas por: <strong class="[ color-primary ]"><?php echo $suspension->temporalidad; ?> Semanas</strong></p>
            <p>Fecha suspensión: <strong> <?php echo getDateTransform($suspension->fechaSuspension); ?></strong>
            <br>Podras ver tu próxima canasta hasta <strong> <?php echo getDateTransform($suspension->fechaFin); ?></strong>
            <br>Fecha próximo corte: <strong> <?php echo getDateTransform($suspension->FechaProximoDescuento); ?></strong></p>

            <p class="[ margin-top--large ]">Desea <strong>renudar</strong> sus entregas?</p>
            <form method="post" action="">
                <input type="hidden" name="action" value="reanudar-canasta">
                <input type="submit" name="enviar" id="submit" class="[ btn btn-secondary btn-small ][ margin-bottom ]" value="Reanudar entregas"/>
            </form>
        <?php endif ?>

    </article>
<?php endif ?>

<?php $costoSemanal = isset($clubCanasta->attr_variation->costoSemanal) ? $clubCanasta->attr_variation->costoSemanal : 0;
if ($opCliente->saldo > $costoSemanal AND $opCliente->suspendido != 1):
    get_template_part('woocommerce/myaccount/templates/canastas-cliente');
elseif($opCliente->saldo < $costoSemanal): ?>
    <article class="[ padding--bottom border-bottom margin-bottom ]">
        <h4>Tu próxima canasta - <span class="[ color-primary ]">$<?php echo $costoSemanal; ?></span></h4>
        <br><p>Tu saldo es de <strong>$<?php echo $opCliente->saldo ?></strong>.<br> Saldo insuficiente para adquirir tú próxima canasta.</p>
    </article>
<?php endif;

