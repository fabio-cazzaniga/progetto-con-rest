class Domanda
{
  constructor(quesito,tipo,risposte)
  {
    this.quesito = quesito;
    this.risposte = risposte; //array
    this.tipo = tipo;
  }
   setTipo(tipo)
  {
    this.tipo = tipo;
  }
   setRisposte(risposte)
  {
    this.risposte = risposte;
  }
  getTipo()
  {
    return this.tipo;
  }
}
class Questionario
{
    constructor(domande,punti,tMin,tMax,target,metodoInvio,id_amministratore)
    {
        this.domande = domande;//array
        this.punti = punti;
        this.tMin = tMin;
        this.tMax = tMax;
        this.target = target;
        this.metodoInvio = metodoInvio;
        this.id_amministratore = id_amministratore;
    }
}
class Esercente
{
  constructor(nome,email,password,percorso_logo,esercizi)
  {
      this.nome = nome;//array
      this.email = email;
      this.percorso_logo = percorso_logo;
      this.esercizi = esercizi;
      this.password = password;
  }
}
class Sconto
{
    constructor(codice,valore,punti)
    {
        this.codice = codice;
        this.valore = valore;
        this.punti = punti;
    }
}
class Target
{
    constructor(genere,età,nucleo)
    {
        this.genere = genere;
        this.età = età;
        this.nucleo = nucleo;
    }
}
