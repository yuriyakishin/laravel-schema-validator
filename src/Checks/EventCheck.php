<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R8: an event with its date and place in Google search and Google's event listings.
 */
class EventCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R8';
    }

    protected function types(): array
    {
        return ['Event'];
    }

    protected function missing(Item $item): array
    {
        $required = $this->absent($item, ['name', 'startDate', 'location']);
        $location = $item->first('location');

        // A place needs an address; an online event has a VirtualLocation with a url instead
        if ($location instanceof Item && $this->isA($location, 'Place') && !$location->has('address')) {
            $required[] = 'location.address';
        }

        return [$required, $this->absent($item, ['endDate', 'eventStatus', 'image', 'description', 'offers', 'organizer'])];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "Event",
              "name": "Floristry workshop",
              "startDate": "2026-12-05T18:00:00+02:00",
              "endDate": "2026-12-05T20:00:00+02:00",
              "eventStatus": "https://schema.org/EventScheduled",
              "location": {
                "@type": "Place",
                "name": "Flower shop",
                "address": { "@type": "PostalAddress", "streetAddress": "1 Khreshchatyk St", "addressLocality": "Kyiv", "addressCountry": "UA" }
              },
              "image": "https://example.com/workshop.jpg",
              "description": "Learn to make a winter bouquet in two hours",
              "offers": { "@type": "Offer", "price": "800", "priceCurrency": "UAH", "url": "https://example.com/workshop" },
              "organizer": { "@type": "Organization", "name": "Flower shop", "url": "https://example.com" }
            }
            JSON;
    }
}
