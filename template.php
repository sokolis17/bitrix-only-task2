<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="contact-form">
	<div class="contact-form__head">
		<div class="contact-form__head-title">Связаться</div>
		<div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и расчет цены с учетом ваших требований</div>
	</div>

	<? // Показываем ошибки если есть
	?>
	<? if ($arResult["isFormErrors"] == "Y"): ?>
		<div class="form-errors">
			<?= $arResult["FORM_ERRORS_TEXT"]; ?>
		</div>
	<? endif; ?>

	<? // Если форма успешно отправлена, показываем сообщение
	?>
	<? if ($arResult["isFormNote"] == "Y"): ?>
		<div class="form-note">
			<?= $arResult["FORM_NOTE"] ?>
		</div>
	<? else: ?>

		<form class="contact-form__form" action="<?= POST_FORM_ACTION_URI ?>" method="POST">
			<?= bitrix_sessid_post() ?>

			<input type="hidden" name="WEB_FORM_ID" value="<?= $arParams["WEB_FORM_ID"] ?>" />

			<div class="contact-form__form-inputs">
				<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>


					<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'textarea'): ?>
						<div class="input contact-form__input">
							<label class="input__label" for="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
								<div class="input__label-text"><?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y"): ?>*<? endif ?></div>


								<?
								$inputType = "text";
								if (stripos($FIELD_SID, "EMAIL") !== false || stripos($arQuestion["CAPTION"], "Email") !== false) {
									$inputType = "email";
								} elseif (stripos($FIELD_SID, "PHONE") !== false || stripos($arQuestion["CAPTION"], "телефон") !== false) {
									$inputType = "tel";
								}
								?>

								<input class="input__input"
									type="<?= $inputType ?>"
									id="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_text_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									value="<?= $arQuestion["STRUCTURE"][0]["VALUE"] ?>"
									<?= $arQuestion['STRUCTURE'][0]['FIELD_PARAM'] ?>
									<? if ($arQuestion["REQUIRED"] == "Y"): ?>required="" <? endif ?>>

								<div class="input__notification">
									<? if ($inputType == "email"): ?>
										Неверный формат почты
									<? else: ?>
										Поле должно содержать не менее 3-х символов
									<? endif ?>
								</div>
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
								<textarea
									id="form_textarea_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									name="form_textarea_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
									<?= $arQuestion['STRUCTURE'][0]['FIELD_PARAM'] ?>><?= $arQuestion["STRUCTURE"][0]["VALUE"] ?></textarea>
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
					type="submit"
					name="web_form_submit"
					value="Y"
					data-success="Отправлено"
					data-error="Ошибка отправки">
					<div class="form-button__title">Оставить заявку</div>
				</button>
			</div>
		</form>

	<? endif ?>
</div>