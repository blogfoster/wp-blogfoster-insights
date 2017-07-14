# blogfoster Insights WordPress plugin

This plugin integrates blogfoster Insights into your WordPress blog.

## Description

This plugin integrates blogfoster Insights into your WordPress blog. It
helps you to understand your blog and gives blogfoster the chance to offer you
the most suitable sponsored posts and campaigns. After you have configured the
plugin in the settings section, blogfoster Insights starts to work.

## Installation

### Install from WordPress Plugin Directory (recommended)

1. [Install the blogfoster Insights][004] plugin from the Plugin Directory
2. Activate the plugin in the Plugin dashboard
3. Go to 'blogfoster Insights'

### Uploading in WordPress Dashboard

1. [Download the `.zip` archive of the plugin from the releases page][001]
2. Navigate to the 'Add New' in the plugins dashboard
3. Navigate to the 'Upload' area
4. Select `wp-blogfoster-insights.zip` from your computer
5. Click 'Install Now'
6. Activate the plugin in the Plugin dashboard
7. Go to 'blogfoster Insights'

## Development

check all php files for correct syntax

```bash
make lint
```

create an archive of the plugin that can be uploaded

```bash
make zip
```

### docker-compose

- install docker and docker-compose ([docker for mac][010])
- run docker-compose commands to start the **wordpress** service

```bash
docker-compose pull
docker-compose build
docker-compose up -d

# check the logs
docker-compose logs -f
```

- after a few seconds wordpress should be available at port **8080**

> **NOTE:** when using docker for mac you can check *127.0.0.1:8080*

### testing the plugin locally

- after creating a local wordpress setup open *127.0.0.1:8080* and follow the wordpress one-time setup procedure
- after doing changes run `make zip` to create a local copy of the plugin as zip file
- upload this zip file to your local installation

## Releasing

This Section describes how to create a new release for github and wordpress.com.

All development process should be reflected in this git repository first before pushing any changes to the central wordpress.com svn repository!

### github

#### code changes

- create a feature branch from master
- do all your changes in the trunk directory
- run `make lint` to check that your php code is still valid
- see the [development section][009] how to run the plugin locally
- update the `Tested up to:` section in the [README.txt][006] if necessary
- create a pull request

#### releasing

- after a new pull request was merged describe the changes in the [CHANGELOG.md][007], [README.txt][006]
- update the `Stable tag:` section in the [README.txt][006] to the next version your going to publish
- update the **Version** tag in [wp-blogfoster-insights.php][005]
- commit changes like: `v${tag}` (e.g. v1.0.0)
- create a tag (e.g. v1.0.0)
- create a release, run `make zip`, and attach the generated **wp-blogfoster-insights.zip** to this release

### wordpress.com

After releasing a new version on github we should reflect these changes to the central wordpress.com svn repository.

- go into the [wp-blogfoster-insights][008] subdirectory where the **trunk** folder is located
- checkout the svn repository [https://plugins.svn.wordpress.org/wp-blogfoster-insights/][003] into this directory
- add all changes to to svn / mark all changes as resolved so that all changes from git are reflected to svn and commit that
- copy the trunk directory into the tags folder giving it the name of the latest tag (which we released on github)
- commit your changes (please contact your admin for the svn credentials)
- read the [wordpress svn getting started guide][002] if necessary

```bash
cd ./wp-blogfoster-insights
# - only checkout the repository the first time, you don't need to do this later on
svn checkout https://plugins.svn.wordpress.org/wp-blogfoster-insights/ .
# - svn stat / svn diff / svn add / svn resolved / svn update *
# - if this is not your first commit just: svn stat / svn diff / svn update *
svn commit -m 'my changes' --username '<username>'
# e.g. our last release on github was 1.0.1
svn cp trunk tags/1.0.1
svn commit -m '1.0.1' --username '<username>'
```

<!-- Links -->

[001]: https://github.com/blogfoster/wp-blogfoster-insights/releases/latest
[002]: https://wordpress.org/plugins/about/svn/
[003]: https://plugins.svn.wordpress.org/wp-blogfoster-insights/
[004]: https://wordpress.org/plugins/wp-blogfoster-insights/
[005]: wp-blogfoster-insights/trunk/wp-blogfoster-insights.php#L19
[006]: wp-blogfoster-insights/trunk/README.txt
[007]: CHANGELOG.md
[008]: wp-blogfoster-insights/
[009]: #development
[010]: https://docs.docker.com/docker-for-mac
