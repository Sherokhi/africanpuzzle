<?php
/**
 * PHP version 5
 *
 * This file is part of SlyWork.
 *
 * SlyWork is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SlyWork is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SlyWork. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author     Lanz Romain <lanz.romain@inosly.com>
 * @copyright  Copyright 2013 (c) InoSly - Lanz Romain <support@slywork.inosly.ch>
 * @version    13.3.20
 * @link       http://slywork.inosly.ch
 * @license    http://www.gnu.org/licenses/gpl.html
 */

namespace Library\Sly\Controller\Component;

class CheckComponent
{
    public function checkEmail($email, $bl = 1) {
        $blacklist = array('10minutemail.com',
                        '20minutemail.com',
                        '2prong.com',
                        '33mail.com',
                        'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijk.com',
                        'afrobacon.com',
                        'anontext.com',
                        'anonymbox.com',
                        'anonymity.ws',
                        'brefemail.com',
                        'cool.fr.nf',
                        'courriel.fr.nf',
                        'courriel.fr.nf',
                        'dandikmail.com',
                        'deadaddress.com',
                        'despam.it',
                        'dispostable.com',
                        'dodgeit.com',
                        'dontreg.com',
                        'dudmail.com',
                        'e4ward.com',
                        'emailwarden.com',
                        'ephemail.net',
                        'fakedemail.com',
                        'fakeinbox.com',
                        'filzmail.com',
                        'get2mail.fr',
                        'gishpuppy.com',
                        'golfilla.info',
                        'greensloth.com',
                        'guerrillamail.com',
                        'haltospam.com',
                        'hushmail.com',
                        'incognitomail.com',
                        'ipoo.org',
                        'iximail.com',
                        'jetable.com',
                        'jetable.fr.nf',
                        'jetable.net',
                        'jetable.org',
                        'kasmail.com',
                        'kleemail.com',
                        'kurzepost.de',
                        'link2mail.net',
                        'lroid.com',
                        'mail-temporaire.fr',
                        'mailcatch.com',
                        'maileater.com',
                        'mailexpire.com',
                        'mailinator.com',
                        'mailnull.com',
                        'mailzilla.org',
                        'mega.zik.dj',
                        'meltmail.com',
                        'mierdamail.com',
                        'mintemail.com',
                        'moncourrier.fr.nf',
                        'monemail.fr.nf',
                        'monmail.fr.nf',
                        'mx0.wwwnew.eu',
                        'mytempemail.com',
                        'mytrashmail.com',
                        'nomail.xl.cx',
                        'nospam.ze.tc',
                        'objectmail.com',
                        'pookmail.com',
                        'proxymail.eu',
                        'put2.net',
                        'rcpt.at',
                        'regbypass.com',
                        'saynotospams.com',
                        'senseless-entertainment.com',
                        'sneakemail.com',
                        'soodonims.com',
                        'spam.la',
                        'spamavert.com',
                        'spambob.com',
                        'spambox.us',
                        'spamcero.com',
                        'spamex.com',
                        'spamfree24.org',
                        'spamgourmet.com',
                        'spamhole.com',
                        'spamify.com',
                        'spaml.com',
                        'spammotel.com',
                        'spamobox.com',
                        'spamspot.com',
                        'speed.1s.fr',
                        'stealth-mode.net',
                        'stop-my-spam.com',
                        'tempemail.net',
                        'tempinbox.comdodgeit.com',
                        'tempomail.fr',
                        'temporaryinbox.com',
                        'tittbit.in',
                        'trash-mail.at',
                        'trashmail.at',
                        'trashmail.me',
                        'trashmail.net',
                        'wegwerfmail.de',
                        'wegwerfmail.net',
                        'wegwerfmail.org',
                        'willhackforfood.biz',
                        'yep.it',
                        'yopmail.com',
                        'yopmail.fr',
                        'yopmail.net',
                        'ypmail.webarnak.fr.eu.org',
                        'zoemail.com');

        $isValid = true;
        $atIndex = strrpos($this->email, "@");
        if (is_bool($atIndex) && !$atIndex)
            $isValid = false;
        else {
            $domain = substr($this->email, $atIndex+1);
            $local = substr($this->email, 0, $atIndex);
            $localLen = strlen($local);
            $domainLen = strlen($domain);

            if ($localLen < 1 || $localLen > 64) {
                // local part length exceeded
                $isValid = false;
            } else if ($domainLen < 1 || $domainLen > 255) {
                // domain part length exceeded
                $isValid = false;
            } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
                // local part starts or ends with '.'
                $isValid = false;
            } else if (preg_match('/\\.\\./', $local)) {
                // local part has two consecutive dots
                $isValid = false;
            } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
                // character not valid in domain part
                $isValid = false;
            } else if (preg_match('/\\.\\./', $domain)) {
                // domain part has two consecutive dots
                $isValid = false;
            } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
                // character not valid in local part unless
                // local part is quoted
                if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
                    $isValid = false;
                }
            } else if ($bl && in_array($domain, $blacklist)) {
                $isValid = false;
            }

            if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
                // domain not found in DNS
                $isValid = false;
            }
        }

        return $isValid;
    }

    public function checkDate($date) {

    }

    public function checkString($string) {
        return (is_string($string) && !empty($string))
    }
}
