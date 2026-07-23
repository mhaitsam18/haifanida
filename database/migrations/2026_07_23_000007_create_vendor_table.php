<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Vendor master — layer 1 of vendor → vendor_service → rate_card.
 *
 * Legal-entity fields are DESCRIPTIVE FACTS only (no policy baked in) — the
 * eligibility rule lives on the component, so an individual (perorangan) can be
 * a trusted hotel supplier yet be rejected by the ticket component.
 *
 * Payment terms and supplier-credit (bridging) fields are carried now even
 * though enforcement lands in phase 4, because they belong to the vendor record
 * and Module 2's cash projection will consume them without a later migration.
 * The price premium an individual charges for fronting our settlement is
 * effectively short-term interest and can be compared against our cost of
 * capital — the schema must be able to express the terms that make that
 * comparison possible.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori')->index();           // visa | handling_id | handling_sa | la | hotel | airline | broker | mutawwif | insurance | health | catering | equipment | transport_id | other

            // Descriptive legal facts (no policy here).
            $table->string('legal_entity_type')->nullable(); // pt | cv | perorangan | other
            $table->boolean('is_incorporated')->nullable();
            $table->string('registration_details')->nullable(); // NIB / NPWP / etc

            // Relationship & vetting — long-standing partners visibly distinct from unvetted new ones.
            $table->string('status')->default('active');   // active | prospective | blacklisted | inactive
            $table->date('relationship_since')->nullable();
            $table->boolean('is_related_party')->default(false); // e.g. our own catering — reporting only, priced at normal publish price

            // Contact.
            $table->string('contact')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('default_currency', 3)->default('IDR');

            // Deposit / payment terms (Addendum 1 §3). Enforcement in phase 4.
            $table->string('deposit_type')->nullable();    // percentage | flat | none
            $table->decimal('deposit_pct', 5, 2)->nullable();
            $table->decimal('deposit_flat', 14, 2)->nullable();
            $table->boolean('deposit_is_layered')->default(false); // multi-stage (token then balance)
            $table->boolean('contingent_liability_on_cancel')->default(false); // cancelling creates a debt, not just a loss
            $table->string('payment_rigidity')->nullable(); // hard | negotiable

            // Supplier credit / bridging — the reason to pay a premium (feeds Module 2).
            $table->boolean('will_bridge_payment')->default(false);   // fronts settlement on our behalf
            $table->integer('bridging_window_days')->nullable();      // typical float in days
            $table->decimal('bridging_ceiling', 16, 2)->nullable();   // practical max they can absorb

            $table->text('payment_terms')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor');
    }
};
