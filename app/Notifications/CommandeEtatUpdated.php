<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommandeEtatUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $commande;

    /**
     * Create a new notification instance.
     */
    public function __construct(Commande $commande)
    {
        // Charger la relation 'etat' si elle n'est pas déjà chargée
        $this->commande = $commande->loadMissing('etat', 'client');
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'commande_id' => $this->commande->id,
            'etat' => $this->commande->etat->etat ?? 'État inconnu',
            'role' => $this->commande->etat->role ?? 'Role inconnu',
            'message' => "Commande N°{$this->commande->id} de {$this->commande->client->nom} {$this->commande->client->prenom} a bien mise à jour à l'état : {$this->commande->etat->etat}.",
            'client' => $this->commande->client->nom ?? 'Client inconnu',
        ];
    }
}
