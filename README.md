# Member List
A replacement for the first party `memberlist` template tags and workflow that adds some much needed updates and funcctionality. 

## Features

1. Usable with native ExpressionEngine Template Tags (no legacy templates needed)
2. Allows for Role specific filtering
3. Uses GET based search params using colloquial field names (no more `m_field_id_12`)
4. Pagination based output using ExpressionEngine pagination tags

## Template Tags

The various tags available

### `exp:member_list:results`

Outputs the specified details in conjunction with the `form` tag. Note there is a `no_results` implementation to display a default view.

#### Params

The available parameters used with the `results` Template Tag.

##### `role_id`

The specific roles, if any, you want to limit the search by. Multiple role_ids can be seperated by a pipe

##### `limit`

How many results to return per page

##### `offset`

The `segment_id` where the offset is placed.

##### `orderby`

How to order results

#### Example

```html
{exp:member_list:results role_id="6|7" limit="10" offset="{segment_2}" orderby="last_name|first_name"}
    {if no_results}
      <h2 style="border:0;">Unfortunately, there are no members available for your search; however, please check back at a later date as members are being added all the time.</h2>
    {/if}
    <p>
      <span class="news_title">{first_name} {last_name}</span>
      <a href="mailto:{email}">{email}</a>
    </p>
{/exp:member_list:results}
```

### `exp:member_list:form`

Generates the search form for use in conjunction with the `results` tag. 

#### Params

The available parameters used with the `form` Template Tag.

##### `return`

The template(s) to direct users to upon form submission

##### `class`

Any CSS class, if any, to apply to the generated form

#### Example

Be aware, that the input names are mapped internally to the specific member field IDs. So you'll only use the Short Name to query on.

```html
<div id="member_left">
  <p class="">Find a Member</p>
  {exp:member_list:form return="{segment_1}"}
    <p>First Name: <br />
    <input name="first_name" type="text" value="{first_name}" /></p>
    <p>Last Name: <br />
    <input name="last_name" type="text" value="{last_name}" /></p>
    <p>City:<br />
    <input name="city" type="text" value="{city}" /></p>
    <p>State: <br />
      <input name="state" type="text" value="{state}" /></p>
    <p>Country: <br />
      <input name="country" type="text" value="{country}" /></p>
    <p align="center">
    <input type="submit" value="Search">
    </p>
    <p>&nbsp;</p>
  {/exp:member_list:form}
</div>
```

### `query_string`

Mostly used in conjunction with the pagination links

#### Example

```
{pagination_url}?{exp:member_list:query_string}
```

## Full Example

```html

<div id="member_left">
  <p class="">Find a Member</p>
  {exp:member_list:form return="{segment_1}"}
    <p>First Name: <br />
    <input name="first_name" type="text" value="{first_name}" /></p>
    <p>Last Name: <br />
    <input name="last_name" type="text" value="{last_name}" /></p>
    <p>City:<br />
    <input name="city" type="text" value="{city}" /></p>
    <p>State: <br />
      <input name="state" type="text" value="{state}" /></p>
    <p>Country: <br />
      <input name="country" type="text" value="{country}" /></p>
    <p align="center">
    <input type="submit" value="Search">
    </p>
    <p>&nbsp;</p>
  {/exp:member_list:form}
</div>

<div id="directory_right">
  {exp:member_list:results role_id="6|7" limit="10" offset="{segment_2}" orderby="last_name|first_name"}
    {if no_results}
      <h2 style="border:0;">Unfortunately, there are no members available for your search; however, please check back at a later date as members are being added all the time.</h2>
    {/if}
    <p>
      <span class="news_title">{first_name} {last_name}</span>
      <a href="mailto:{email}">{email}</a>
    </p>

  {if count == {total_results}}
    {paginate}
    <div class="itempadbig"><p class="pagination">
      <table cellpadding="0" cellspacing="0" border="0" class="paginateBorder">
        <tr>
          <td><div class="paginateStat">{current_page} of {total_pages}</div></td>
        </tr>
        <tr>
          <td>
            {pagination_links}
            {first_page}
            <a href="{pagination_url}?{exp:member_list:query_string}" class="page-first">First Page</a>
            {/first_page}

            {previous_page}
            <a href="{pagination_url}?{exp:member_list:query_string}" class="page-previous">Previous Page</a>
            {/previous_page}

            {page}
            {if current_page}
              {pagination_page_number}
            {if:else}
              <a href="{pagination_url}?{exp:member_list:query_string}" class="page-{pagination_page_number} ">{pagination_page_number}</a>
            {/if}
            {/page}

            {next_page}
            <a href="{pagination_url}?{exp:member_list:query_string}" class="page-next">Next Page</a>
            {/next_page}

            {last_page}
            <a href="{pagination_url}?{exp:member_list:query_string}" class="page-last">Last Page</a>
            {/last_page}

            {/pagination_links}
          </td>
        </tr>
      </table>
      </p></div>
    {/paginate}
  {/if}
  {/exp:member_list:results}
</div>

```