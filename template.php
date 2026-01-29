<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="contact-form">
	<div class="contact-form__head">
		<div class="contact-form__head-title">Связаться</div>
		<div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и расчет цены с учетом ваших требований</div>
	</div>

	<? if ($arResult["isFormNote"] == "Y"): ?>
		<div class="form-note">
			<?= $arResult["FORM_NOTE"] ?>
		</div>
	<? else: ?>

		<form class="contact-form__form" method="POST">
			<?= bitrix_sessid_post() ?>

			<div class="contact-form__form-inputs">
				<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
					<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text'): ?>
						<div class="input contact-form__input">
							<label class="input__label" for="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
								<div class="input__label-text"><?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y"): ?>*<? endif ?></div>
								<input class="input__input"
									type="text"
									id="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									value="<?= $arQuestion["STRUCTURE"][0]["VALUE"] ?>"
									<? if ($arQuestion["REQUIRED"] == "Y"): ?>required="" <? endif ?>>
								<div class="input__notification">Поле должно содержать не менее 3-х символов</div>
							</label>
						</div>
					<? endif ?>
					<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'email'): ?>
						<div class="input contact-form__input">
							<label class="input__label" for="form_email_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
								<div class="input__label-text"><?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y"): ?>*<? endif ?></div>
								<input class="input__input"
									type="email"
									id="form_email_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_email_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									value="<?= $arQuestion["STRUCTURE"][0]["VALUE"] ?>"
									<? if ($arQuestion["REQUIRED"] == "Y"): ?>required="" <? endif ?>>
								<div class="input__notification">Неверный формат почты</div>
							</label>
						</div>
					<? endif ?>
					<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'tel'): ?>
						<div class="input contact-form__input">
							<label class="input__label" for="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
								<div class="input__label-text"><?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y"): ?>*<? endif ?></div>
								<input class="input__input"
									type="tel"
									id="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									value="<?= $arQuestion["STRUCTURE"][0]["VALUE"] ?>"
									data-inputmask="'mask': '+79999999999', 'clearIncomplete': 'true'"
									maxlength="12"
									x-autocompletetype="phone-full"
									<? if ($arQuestion["REQUIRED"] == "Y"): ?>required="" <? endif ?>>
								<div class="input__notification">Поле должно содержать не менее 3-х символов</div>
							</label>
						</div>
					<? endif ?>

				<? endforeach ?>
			</div>
			<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
				<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea'): ?>
					<div class="contact-form__form-message">
						<div class="input">
							<label class="input__label" for="form_textarea_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
								<div class="input__label-text"><?= $arQuestion["CAPTION"] ?></div>
								<textarea class="input__input"
									type="text"
									id="form_textarea_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_textarea_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									value=""><?= $arQuestion["STRUCTURE"][0]["VALUE"] ?></textarea>
								<div class="input__notification"></div>
							</label>
						</div>
					</div>
				<? endif ?>
			<? endforeach ?>

			<div class="contact-form__bottom">
				<div class="contact-form__bottom-policy">
					Нажимая «Отправить», Вы подтверждаете, что ознакомлены, полностью согласны и принимаете условия «Согласия на обработку персональных данных».
				</div>
				<button class="form-button contact-form__bottom-button"
					data-success="Отправлено"
					data-error="Ошибка отправки">
					<div class="form-button__title">Оставить заявку</div>
				</button>
			</div>
		</form>

	<? endif ?>
</div>