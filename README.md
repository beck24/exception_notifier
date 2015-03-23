# Exception Notifier

When an error (called an exception in code-talk) occurs it can confuse users,
often they will not know what to do and issues will go unreported.  Additionally
exceptions can happen during background processes or ajax endpoints that aren't
generally visible.  As such these errors also go un/under-reported.  This plugin
allows you to assign a set of email addresses to receive notifications whenever
an exception occurs.  The email will contain a description of the error as well
as a stack trace - all information that can be useful for a developer to track
down an issue.

Faster, automated reporting = faster response for a fix.


Additionally, the default Elgg exception page has a cryptic message with a
timestamp exception number which looks strange and scary to non-developers. 
Since an email can be sent out with that information, the settings of the plugin
allow for custom html to be entered.  This custom html will be displayed to the
end user instead of the default Elgg output.
