    /**
     * boxzilla minimized mode - hotjar poll style implementation
     *
     * box can be minimized, but not dismissed. after first dismissal, triggers
     * in minimized mode by default (cookie).
     * 
     * Made by https://github.com/lkraav (a Boxzilla user) and not officially maintained by the Boxzilla team.
     * Might or might not work for your theme / website.
     *
     * @see https://github.com/ibericode/boxzilla-wp/issues/87
     * @since 2017.02.05
     */
    
    $(document).ready( function() {

        if ( typeof Boxzilla === "undefined" ) {
            return;
        }

        var boxzillaSlug = "vota-uhendust";

        /**
         * overrides `Box.prototype.toggle()`
         *
         * @since 2017.02.05
         */
        function toggleMinimize( show ) {

            // revert visibility if no explicit argument is given
            if ( typeof show === "undefined" ) {
                show = !this.visible;
            }

            // is box already at desired visibility?
            // minimized mode always needs action
            if ( show === ( this.visible && ! this.minimized ) ) {
                return false;
            }

            // set new visibility status
            this.visible = show;

            // must force show when minimized
            // must force show when box has never been dismissed (first load)
            show = ( show && this.minimized ) || ( show && ! this.isCookieSet() );

            // trigger event
            Boxzilla.trigger('box.' + (show ? 'show' : 'hide'), [this]);

            return true;

        }

        /**
         * overrides `Box.prototype.dismiss()` close button click handler
         *
         * @since 2017.02.05
         */
        function dismissMinimize( e ) {

            // restore
            if ( this.minimized ) {
                this.show();
                return false;
            }

            // minimize box element
            this.hide();

            // set cookie
            if ( this.config.cookie && this.config.cookie.dismissed ) {
                this.setCookie( this.config.cookie.dismissed );
            }

            this.dismissed = true;

            Boxzilla.trigger( 'box.dismiss', [this] );

            return true;

        }

        /**
         * overrides default handlers
         *
         * @since 2017.02.05
         */
        Boxzilla.on( "done", function() {

            var options = window.boxzilla_options;

            for (var i = 0; i < options.boxes.length; i++) {

                var boxOpts = options.boxes[i];

                var box = Boxzilla.get( boxOpts.id );

                if ( boxzillaSlug === box.config.post.slug ) {

                    // @see http://stackoverflow.com/a/32809957/35946
                    box.closeIcon.outerHTML = box.closeIcon.outerHTML;

                    // @see http://stackoverflow.com/a/24446288/35946
                    $( box.element ).on( "click", "." + box.closeIcon.className, function( e ) {
                        dismissMinimize.call( box, e );
                    } );

                    box.mayAutoShow = function() {
                        return null === this.minimized;
                    };

                    box.minimized = null;

                    box.toggle = toggleMinimize;

                    // avoid `addEventListener resize` erroneously restoring minimized state
                    box.setCustomBoxStyling = function() {};

                }

            }

        } );

        /**
         * overrides `Box.prototype.show()`, uses `max-height` css.
         *
         * @since 2017.02.05
         */
        Boxzilla.on( "box.show", function( box ) {

            if ( boxzillaSlug !== box.config.post.slug ) {
                return;
            }

            $( box.element ).css( { "display": "block", "max-height": "none" } );

            $( box.element ).find( ".boxzilla-close-icon" ).html( "&times;" );

            box.minimized = false;

        } );

        /**
         * overrides `Box.prototype.hide()`, uses `max-height` css
         *
         * @see http://stackoverflow.com/questions/2345784/jquery-get-height-of-hidden-element-in-jquery
         * @since 2017.02.05
         */
        Boxzilla.on( "box.hide", function( box ) {

            if ( boxzillaSlug !== box.config.post.slug ) {
                return;
            }

            $( box.element )
                .css( { "display": "block", "max-height": "none", "overflow": "hidden", "visibility": "hidden" } )
                .css( { "max-height": $( box.element ).find( ".gform_heading" ).outerHeight() + "px" } )
                .css( { "visibility": "visible" } )
            ;

            $( box.element ).find( ".boxzilla-close-icon" ).html( "&#x25B4;" );

            box.minimized = true;

        } );

    } );
