<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\EmailVersturen;
use SnelstartPHP\Model\FactuurRelatie;
use SnelstartPHP\Model\NaamWaarde;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type as Types;
use DateTimeInterface;

final class Relatie extends SnelstartObject
{
    /**
     * Datum waarop de gegevens van deze relatie zijn aangepast
     */
    private DateTimeInterface|null $modifiedOn = null;

    /**
     * @see Types\Relatiesoort
     * @var Types\Relatiesoort[]|null
     */
    private array|null $relatiesoort = null;

    /**
     * Het relatienummer
     */
    private int|null $relatiecode = 0;

    /**
     * De volledige naam van de relatie.
     */
    private string|null $naam = null;

    private Adres|null $vestigingsAdres = null;

    private Adres|null $correspondentieAdres = null;

    /**
     * Het telefoonnummer van de relatie.
     */
    private string|null $telefoon = null;

    /**
     * Het mobiele nummer van de relatie.
     */
    private string|null $mobieleTelefoon = null;

    /**
     * Het hoofd-emailadres van de relatie.
     */
    private string|null $email = null;

    /**
     * Het BTW-nummer van de relatie.
     */
    private string|null $btwNummer = null;

    /**
     * De standaard factuurkorting die aan deze relatie wordt gegeven (optioneel).
     */
    private Money|null $factuurkorting = null;

    private int $krediettermijn = 0;

    /**
     * Geeft true terug als Types\IncassoSoort Core of B2B is.
     * Dit veld komt overeen met het veld Betaalopdracht in SnelStart Desktop
     *
     * @see Types\Incassosoort
     */
    private bool $bankieren = false;

    /**
     * Een vlag dat aangeeft of een relatie niet meer actief is binnen de administratie.
     * Indien true, dan kan de relatie als "verwijderd" worden beschouwd.
     */
    private bool $nonactief = false;

    /**
     * Het standaard kredietlimiet (in €) van aan deze relatie wordt gegeven (optioneel).
     */
    private Money|null $kredietLimiet = null;

    private string|null $memo = null;

    /**
     * Het nummer van de Kamer van Koophandel van de relatie.
     */
    private string|null $kvkNummer = null;

    /**
     * De URL van de website van de relatie.
     */
    private string|null $websiteUrl = null;

    /**
     * Het soort aanmaning dat van toepassing is op de relatie (optioneel).
     *
     * @see Types\Aanmaningsoort
     */
    private Types\Aanmaningsoort|null $aanmaningsoort = null;

    /**
     * De emailgegevens voor het versturen van offertes.
     */
    private EmailVersturen|null $offerteEmailVersturen = null;

    /**
     * De emailgegevens voor het versturen van bevestigingen.
     */
    private EmailVersturen|null $bevestigingsEmailVersturen = null;

    /**
     * De emailgegevens voor het versturen van facturen.
     */
    private EmailVersturen|null $factuurEmailVersturen = null;

    /**
     * De emailgegevens voor het versturen van aanmaningen.
     */
    private EmailVersturen|null $aanmaningEmailVersturen = null;

    /**
     * De emailgegevens voor het versturen van offerte aanvragen.
     */
    private EmailVersturen|null $offerteAanvraagEmailVersturen = null;

    /**
     * De emailgegevens voor het versturen van bestellingen.
     */
    private EmailVersturen|null $bestellingEmailVersturen = null;

    /**
     * Een vlag dat aangeeft of een UBL-bestand als bijlage bij een email moet worden toegevoegd bij het versturen van
     * facturen.
     */
    private bool $ublBestandAlsBijlage = true;

    private string|null $iban = null;

    private string|null $bic = null;

    private Types\Incassosoort|null $incassoSoort = null;

    private string|null $inkoopBoekingenUri = null;

    private string|null $verkoopBoekingenUri = null;

    private FactuurRelatie|null $factuurRelatie = null;

    /**
     * @var NaamWaarde[]
     */
    private array $extraVeldenKlant = [];

    /**
     * @var string[]
     */
    public static array $editableAttributes = [
        "id",
        "modifiedOn",
        "relatiesoort",
        "relatiecode",
        "naam",
        "vestigingsAdres",
        "correspondentieAdres",
        "telefoon",
        "mobieleTelefoon",
        "email",
        "btwNummer",
        "factuurkorting",
        "krediettermijn",
        "bankieren",
        "nonactief",
        "kredietLimiet",
        "memo",
        "kvkNummer",
        "websiteUrl",
        "aanmaningsoort",
        "offerteEmailVersturen",
        "bevestigingsEmailVersturen",
        "factuurEmailVersturen",
        "aanmaningEmailVersturen",
        "offerteAanvraagEmailVersturen",
        "bestellingEmailVersturen",
        "ublBestandAlsBijlage",
        "iban",
        "bic",
        "incassoSoort",
        "factuurRelatie",
        "extraVeldenKlant",
    ];

    public function getModifiedOn(): DateTimeInterface|null
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(DateTimeInterface|null $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    /**
     * @return Types\Relatiesoort[]
     */
    public function getRelatiesoort(): array
    {
        return $this->relatiesoort ?? [];
    }

    /**
     * @param Types\Relatiesoort[] $relatiesoort
     */
    public function setRelatiesoort(Types\Relatiesoort ...$relatiesoort): self
    {
        $this->relatiesoort = $relatiesoort;

        return $this;
    }

    public function getRelatiecode(): int|null
    {
        return $this->relatiecode;
    }

    public function setRelatiecode(int|null $relatiecode): self
    {
        $this->relatiecode = $relatiecode;

        return $this;
    }

    public function getNaam(): string|null
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getVestigingsAdres(): Adres
    {
        return $this->vestigingsAdres ?? new Adres();
    }

    public function setVestigingsAdres(Adres $vestigingsAdres): self
    {
        $this->vestigingsAdres = $vestigingsAdres;

        return $this;
    }

    public function getCorrespondentieAdres(): Adres
    {
        return $this->correspondentieAdres ?? new Adres();
    }

    public function setCorrespondentieAdres(Adres $correspondentieAdres): self
    {
        $this->correspondentieAdres = $correspondentieAdres;

        return $this;
    }

    public function getTelefoon(): string|null
    {
        return $this->telefoon;
    }

    public function setTelefoon(string|null $telefoon): self
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    public function getMobieleTelefoon(): string|null
    {
        return $this->mobieleTelefoon;
    }

    public function setMobieleTelefoon(string|null $mobieleTelefoon): self
    {
        $this->mobieleTelefoon = $mobieleTelefoon;

        return $this;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function setEmail(string|null $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBtwNummer(): string|null
    {
        return $this->btwNummer;
    }

    public function setBtwNummer(string|null $btwNummer): self
    {
        $this->btwNummer = $btwNummer;

        return $this;
    }

    public function getFactuurkorting(): Money|null
    {
        return $this->factuurkorting;
    }

    public function setFactuurkorting(Money|null $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    public function getKrediettermijn(): int
    {
        return $this->krediettermijn;
    }

    public function setKrediettermijn(int|null $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn ?? $this->krediettermijn;

        return $this;
    }

    public function isBankieren(): bool
    {
        return $this->bankieren;
    }

    public function setBankieren(bool $bankieren): self
    {
        $this->bankieren = $bankieren;

        return $this;
    }

    public function isNonactief(): bool
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getKredietLimiet(): Money|null
    {
        return $this->kredietLimiet;
    }

    public function setKredietLimiet(Money|null $kredietLimiet): self
    {
        $this->kredietLimiet = $kredietLimiet;

        return $this;
    }

    public function getMemo(): string|null
    {
        return $this->memo;
    }

    public function setMemo(string|null $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getKvkNummer(): string|null
    {
        return $this->kvkNummer;
    }

    public function setKvkNummer(string|null $kvkNummer): self
    {
        $this->kvkNummer = $kvkNummer;

        return $this;
    }

    public function getWebsiteUrl(): string|null
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string|null $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getAanmaningsoort(): Types\Aanmaningsoort|null
    {
        return $this->aanmaningsoort;
    }

    public function setAanmaningsoort(Types\Aanmaningsoort|null $aanmaningsoort): self
    {
        $this->aanmaningsoort = $aanmaningsoort;

        return $this;
    }

    public function getOfferteEmailVersturen(): EmailVersturen
    {
        return $this->offerteEmailVersturen ?? new EmailVersturen(false);
    }

    public function setOfferteEmailVersturen(EmailVersturen $offerteEmailVersturen): self
    {
        $this->offerteEmailVersturen = $offerteEmailVersturen;

        return $this;
    }

    public function getBevestigingsEmailVersturen(): EmailVersturen
    {
        return $this->bevestigingsEmailVersturen ?? new EmailVersturen(false);
    }

    public function setBevestigingsEmailVersturen(EmailVersturen $bevestigingsEmailVersturen): self
    {
        $this->bevestigingsEmailVersturen = $bevestigingsEmailVersturen;

        return $this;
    }

    public function getFactuurEmailVersturen(): EmailVersturen
    {
        return $this->factuurEmailVersturen ?? new EmailVersturen(false);
    }

    public function setFactuurEmailVersturen(EmailVersturen $factuurEmailVersturen): self
    {
        $this->factuurEmailVersturen = $factuurEmailVersturen;

        return $this;
    }

    public function getAanmaningEmailVersturen(): EmailVersturen
    {
        return $this->aanmaningEmailVersturen ?? new EmailVersturen(false);
    }

    public function setAanmaningEmailVersturen(EmailVersturen $aanmaningEmailVersturen): self
    {
        $this->aanmaningEmailVersturen = $aanmaningEmailVersturen;

        return $this;
    }

    public function getOfferteAanvraagEmailVersturen(): EmailVersturen
    {
        return $this->offerteAanvraagEmailVersturen ?? new EmailVersturen(false);
    }

    public function setOfferteAanvraagEmailVersturen(EmailVersturen $offerteAanvraagEmailVersturen): self
    {
        $this->offerteAanvraagEmailVersturen = $offerteAanvraagEmailVersturen;

        return $this;
    }

    public function getBestellingEmailVersturen(): EmailVersturen
    {
        return $this->bestellingEmailVersturen ?? new EmailVersturen(false);
    }

    public function setBestellingEmailVersturen(EmailVersturen $bestellingEmailVersturen): self
    {
        $this->bestellingEmailVersturen = $bestellingEmailVersturen;

        return $this;
    }

    public function isUblBestandAlsBijlage(): bool
    {
        return $this->ublBestandAlsBijlage;
    }

    public function setUblBestandAlsBijlage(bool $ublBestandAlsBijlage): self
    {
        $this->ublBestandAlsBijlage = $ublBestandAlsBijlage;

        return $this;
    }

    public function getIban(): string|null
    {
        return $this->iban;
    }

    public function setIban(string|null $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): string|null
    {
        return $this->bic;
    }

    public function setBic(string|null $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getIncassoSoort(): Types\Incassosoort|null
    {
        return $this->incassoSoort;
    }

    public function setIncassoSoort(Types\Incassosoort|null $incassoSoort): self
    {
        $this->incassoSoort = $incassoSoort;

        return $this;
    }

    public function getInkoopBoekingenUri(): string|null
    {
        return $this->inkoopBoekingenUri;
    }

    public function setInkoopBoekingenUri(string|null $inkoopBoekingenUri): self
    {
        $this->inkoopBoekingenUri = $inkoopBoekingenUri;

        return $this;
    }

    public function getVerkoopBoekingenUri(): string|null
    {
        return $this->verkoopBoekingenUri;
    }

    public function setVerkoopBoekingenUri(string|null $verkoopBoekingenUri): self
    {
        $this->verkoopBoekingenUri = $verkoopBoekingenUri;

        return $this;
    }

    public function getFactuurRelatie(): FactuurRelatie|null
    {
        return $this->factuurRelatie;
    }

    public function setFactuurRelatie(FactuurRelatie|null $factuurRelatie): self
    {
        $this->factuurRelatie = $factuurRelatie;

        return $this;
    }

    public function getExtraVeldenKlant(): array
    {
        return $this->extraVeldenKlant;
    }

    public function setExtraVeldenKlant(NaamWaarde ... $extraVeldenKlant): self
    {
        $this->extraVeldenKlant = $extraVeldenKlant;

        return $this;
    }
}
