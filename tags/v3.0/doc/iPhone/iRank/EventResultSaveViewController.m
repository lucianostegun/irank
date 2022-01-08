//
//  EventResultSaveViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventResultSaveViewController.h"
#import "EventPlayer.h"
#import "JSON.h"
#import "iRankAppDelegate.h"
#import "Reachability.h"

@implementation EventResultSaveViewController
@synthesize event;
@synthesize eventPlayer;
@synthesize numberFormatter;
@synthesize eventPlayerList;
@synthesize theTextField;
//@synthesize resultTableView;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {

        numberFormatter = [[NSNumberFormatter alloc] init];
        [numberFormatter setNumberStyle:NSNumberFormatterCurrencyStyle];
        [numberFormatter setDecimalSeparator:@","];
        [numberFormatter setCurrencyCode:@""];
        [numberFormatter setCurrencySymbol:@""];
    }
    
    return self;
}

-(void)viewWillAppear:(BOOL)animated {
    
    currentPosition = 0;
    
    [self loadPlayerInfo:currentPosition];
    
    [super viewWillAppear:animated];
    
    if( ![event.gameStyle isEqualToString:@"ring"] ){
        
        buyin.enabled           = NO;
        btnIncraseBuyin.enabled = NO;
        btnDecraseBuyin.enabled = NO;
        lblPrize.hidden         = YES;
        prize.hidden            = YES;
        ringInfo.hidden         = YES;
    }else{
        
        buyin.enabled           = YES;
        btnIncraseBuyin.enabled = YES;
        btnDecraseBuyin.enabled = YES;
        lblPrize.hidden         = NO;
        prize.hidden            = NO;
        ringInfo.hidden         = NO;
    }
    
    rebuy.enabled           = event.allowRebuy;
    addon.enabled           = event.allowAddon;
    btnIncraseRebuy.enabled = event.allowRebuy;
    btnDecraseRebuy.enabled = event.allowRebuy;
    btnIncraseAddon.enabled = event.allowAddon;
    btnDecraseAddon.enabled = event.allowAddon;
    
    viewResumeMode = NO;
    [segmentedControl setSelectedSegmentIndex:0];
        
    self.title = NSLocalizedString(@"Results", @"eventResultSave");
    self.navigationItem.rightBarButtonItem = doneButton;
    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self selector:@selector (keyboardWillShow:) name:UIKeyboardWillShowNotification object:self.view.window];
}

-(void)viewWillDisappear:(BOOL)animated {
    
    [super viewWillDisappear:animated];
    [[NSNotificationCenter defaultCenter] removeObserver:self name: UIKeyboardWillShowNotification object:nil];
}

-(void)viewDidAppear:(BOOL)animated {
    
    [super viewDidAppear:animated];
}

-(void)loadPlayerInfo:(int)playerPositionIndex {

    eventPlayer         = [eventPlayerList objectAtIndex:playerPositionIndex];
    playerName.text     = eventPlayer.player.fullName;
    playerPosition.text = [NSString stringWithFormat:@"%i%@ %@", (playerPositionIndex+1), NSLocalizedString(@"ordinalPosition", @"eventResultSave"), NSLocalizedString(@"position", @"eventResultSave")];
    eventName.text      = event.eventName;
    eventPlaceDate.text = [NSString stringWithFormat:@"@%@ - %@ %@", event.eventPlace, event.eventDate, event.startTime];
    
    if( ![event.gameStyle isEqualToString:@"ring"] )
        eventPlayer.buyin = event.buyin;
    
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
    prize.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.prize]]];
}

- (void)keyboardWillShow: (NSNotification *)notif {
    
    NSDictionary* info  = [notif userInfo];
    NSValue *aValue     = [info objectForKey:UIKeyboardBoundsUserInfoKey];
    CGSize keyboardSize = [aValue CGRectValue].size;
    
    float bottomPoint  = (theTextField.frame.origin.y + theTextField.frame.size.height + 10);
    scrollAmount = keyboardSize.height - (self.view.frame.size.height - bottomPoint);
    
    if(scrollAmount > 0) {
        moveViewUp = YES;
        [self scrollTheView:YES];
    }else
        moveViewUp = NO;
}

- (void)scrollTheView: (BOOL)movedUp {
    
    /*
     beginAnimations:: possui argumentos para passar informacão ao delegate da animação.
     Já que não vou usar nenhum delegate na aplicação, devo setar os argumentos para nil ou NULL.
     
     nil é usado quando há um ponteiro null para um objeto
     NULL é usado quando há um ponteiro null para qualquer outra coisa 
     */
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    CGRect rect = self.view.frame;
    
    if(movedUp){
        rect.origin.y -= scrollAmount;
    }else{
        rect.origin.y += scrollAmount;
    }
    
    self.view.frame = rect;
    [UIView commitAnimations];
}

-(IBAction)loadNextPlayerInfo:(id)sender {
    
    currentPosition++;

    if ( currentPosition >= [eventPlayerList count] )
        currentPosition = 0;
    
    [self loadPlayerInfo:currentPosition];
}

-(IBAction)loadPreviousPlayerInfo:(id)sender {

    currentPosition--;
    
    if ( currentPosition < 0 )
        currentPosition = [eventPlayerList count]-1;
    
    [self loadPlayerInfo:currentPosition];
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    doneButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(doneButtonTouchUp:)];
    saveButton = [[UIBarButtonItem alloc] initWithTitle:NSLocalizedString(@"save", @"eventResultSave") style:UIBarButtonItemStyleDone target:self action:@selector(saveButtonTouchUp:)];
    
    activityIndicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhite];
    [activityIndicator setHidesWhenStopped:YES];
    [activityIndicator setHidden:YES];
    
    activityIndicatorButton =  [[UIBarButtonItem alloc] initWithCustomView:activityIndicator];
    
    
    [lblBuyin setText:NSLocalizedString(@"Buy-in", nil)];
    [lblRebuy setText:NSLocalizedString(@"Rebuy", nil)];
    [lblAddon setText:NSLocalizedString(@"Add-on", nil)];
    [lblPrize setText:NSLocalizedString(@"Prize", nil)];
    [lblPrizeInfo setText:NSLocalizedString(@"prizeInfo", @"eventResult")];
    
    [btnPrevious setTitle:NSLocalizedString(@"previous", @"eventResult")];
    [btnNext setTitle:NSLocalizedString(@"next", @"eventResult")];
    
    [btnCalculatePrize setTitle:NSLocalizedString(@"calculate prize", @"eventResult")];
    [segmentedControl setTitle:NSLocalizedString(@"ranking", @"eventResult") forSegmentAtIndex:0];
    [segmentedControl setTitle:NSLocalizedString(@"resume", @"eventResult") forSegmentAtIndex:1];
}

-(void)doneButtonTouchUp:(id)sender {
    
    [[self view] endEditing:YES];

    [self.navigationController pushViewController:resultPreviewViewController animated:YES];
    
    [resultTableView reloadData];
    
    if( event.hasOfflineResult || [event.gameStyle isEqualToString:@"ring"] ){

        saveButton.enabled        = YES;
        btnCalculatePrize.enabled = NO;
    }else{
     
        saveButton.enabled        = NO;
        btnCalculatePrize.enabled = YES;
    }
    
    resultPreviewViewController.navigationItem.rightBarButtonItem = saveButton;
}

-(void)saveButtonTouchUp:(id)sender {
    
    BOOL saveOffline = (!appDelegate.wifiConnection || !appDelegate.hostActive);
    saveOffline      = (saveOffline && [[appDelegate userDefaults] boolForKey:kSaveOfflineKey]);
    saveOffline      = saveOffline || kForceOfflineSaving;
    
    NSString *confirmMessage = NSLocalizedString(@"Confirm saving and sending the event result by e-mail?", @"eventResultSave");

    if( saveOffline && !event.hasOfflineResult )
        confirmMessage = NSLocalizedString(@"Confirm saving the offline result of this event?", @"eventResultSave");
        
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:NSLocalizedString(@"Confirm", @"eventResultSave") message:confirmMessage delegate:self cancelButtonTitle:NSLocalizedString(@"No", nil) otherButtonTitles:NSLocalizedString(@"Yes", nil), nil];
    [alert show];
    [alert release];
}

-(void)saveEventResult {
    
    [appDelegate showLoadingView:NSLocalizedString(@"saving result...", @"eventResultSave")];
    
    [self performSelector:@selector(doSaveEventResult) withObject:nil afterDelay:0];
}

-(void)doSaveEventResult {

    BOOL saveOffline = (!appDelegate.wifiConnection || !appDelegate.hostActive);
    saveOffline = (saveOffline && [[appDelegate userDefaults] boolForKey:kSaveOfflineKey]);
    saveOffline = saveOffline || kForceOfflineSaving;
    
    if( event.hasOfflineResult )
        saveOffline = NO;
    
    [event saveResult:self saveOffline:saveOffline];
}

-(void)concludeSaveResult {
    
    [appDelegate hideLoadingView];
    
    [appDelegate showAlert:NSLocalizedString(@"Result saved", @"eventResultSave") message:NSLocalizedString(@"Event result has been successfully saved!", @"eventResultSave")];
    appDelegate.refreshHome = YES;
}

-(void)concludeSaveResultWithError {
    
    [appDelegate hideLoadingView];
    
    [appDelegate showAlert:NSLocalizedString(@"Fail", @"alert") message:NSLocalizedString(@"It was unable to save the event result!\nPlease, try again.", @"eventResultSave")];
    appDelegate.refreshHome = NO;
}

-(void)concludeCalculatePrize {
    
    [resultTableView reloadData];
    saveButton.enabled        = YES;
    btnCalculatePrize.enabled = YES;
    resultPreviewViewController.navigationItem.rightBarButtonItem = saveButton;
    [activityIndicator stopAnimating];
}

- (void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex{

	if (buttonIndex == 0) {
		
        
	}else{
        
        [self saveEventResult];
	}
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(IBAction)incraseBuyinValue:(id)sender {
    
    eventPlayer.buyin += event.rankingBuyin;
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
}

-(IBAction)decraseBuyinValue:(id)sender {
    
    eventPlayer.buyin -= event.rankingBuyin;

    if( eventPlayer.buyin < 0 )
        eventPlayer.buyin = 0;
    
    buyin.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]]];
}

-(IBAction)incraseRebuyValue:(id)sender {
    
    eventPlayer.rebuy += event.rankingBuyin;
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
}

-(IBAction)decraseRebuyValue:(id)sender {
    
    eventPlayer.rebuy -= event.rankingBuyin;
    
    if( eventPlayer.rebuy < 0 )
        eventPlayer.rebuy = 0;
    
    rebuy.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]]];
}

-(IBAction)incraseAddonValue:(id)sender {
    
    eventPlayer.addon += event.rankingBuyin;
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
}

-(IBAction)decraseAddonValue:(id)sender {
    
    eventPlayer.addon -= event.rankingBuyin;
    
    if( eventPlayer.addon < 0 )
        eventPlayer.addon = 0;
    
    addon.text = [NSString stringWithFormat:@"%@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]]];
}

-(BOOL)textFieldShouldReturn:(UITextField *) textField {
    
    [textField resignFirstResponder];
    
    if(moveViewUp)
        [self scrollTheView:NO];
    
    return YES;
}


-(BOOL)textField:(UITextField *)textField shouldChangeCharactersInRange:(NSRange)range replacementString:(NSString *)string {

    NSString *nameRegex = @"[0-9,]"; 
    NSPredicate *nameTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", nameRegex]; 
    BOOL isNumber = [nameTest evaluateWithObject:string];
    
    return (isNumber || [string isEqualToString:@""]);
}

#pragma mark - Tableview methods

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    if( viewResumeMode )
        return 3;
    else
        return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    if( viewResumeMode ){
    
        switch ( section ) {
            case 0:
                return [eventPlayerBuyinList count];
                break;
            case 1:
                return [eventPlayerRebuyList count];
                break;
            case 2:
                return [eventPlayerAddonList count];
                break;
        }
        [eventPlayerList count];
    }
    
    return [eventPlayerList count];
        
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    static NSString *CellIdentifier = @"Cell";
    
    NSMutableArray *eventPlayerListTemp;
    
    if( viewResumeMode ){
        
        switch ( indexPath.section ) {
            case 0:
                eventPlayerListTemp = eventPlayerBuyinList;
                break;
            case 1:
                eventPlayerListTemp = eventPlayerRebuyList;
                break;
            case 2:
                eventPlayerListTemp = eventPlayerAddonList;
                break;
        }
    }else{
    
        eventPlayerListTemp = eventPlayerList;
    }
    
    
    
    EventPlayer *aEventPlayer = [eventPlayerListTemp objectAtIndex:indexPath.row];
    Player *player = [aEventPlayer player];
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];

    NSString *detailText;
    NSString *labelText;
    
    if( viewResumeMode ){

        labelText = [player fullName];
        
        switch ( indexPath.section ) {
            case 0:
                detailText = [NSString stringWithFormat:@"%@: %@", NSLocalizedString(@"Buy-in", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.buyin]]];
                break;
            case 1:
                detailText = [NSString stringWithFormat:@"%@: %@", NSLocalizedString(@"Rebuy", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.rebuy]]];
                break;
            case 2:
                detailText = [NSString stringWithFormat:@"%@: %@", NSLocalizedString(@"Add-on", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.addon]]];
                break;
        }
        
        
    }else{
    
        labelText = [NSString stringWithFormat:@"%i%@ %@", indexPath.row+1, NSLocalizedString(@"ordinalPlace", @"eventResultSave"), [player fullName]];
        
        detailText = [NSString stringWithFormat:@"%@: %@, %@: %@, %@: %@ / %@: %@", NSLocalizedString(@"B", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.buyin]], NSLocalizedString(@"R", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.rebuy]], NSLocalizedString(@"A", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.addon]], NSLocalizedString(@"Prize", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:aEventPlayer.prize]]];
    }
    
    cell.detailTextLabel.text = detailText;
    cell.textLabel.text       = labelText;
    
    detailText = nil;
    labelText  = nil;
    
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
    if( viewResumeMode ){
    
        switch ( section ) {
            case 0:
                return [NSString stringWithFormat:@"%@\n%@", event.eventName, NSLocalizedString(@"Buy-in", nil)];
                break;
            case 1:
                return NSLocalizedString(@"Rebuy", nil);
                break;
            case 2:
                return NSLocalizedString(@"Add-on", nil);
                break;
        }
    }
    
    return [NSString stringWithFormat:@"%@\n%@ %@", event.eventName, event.eventDate, event.startTime];
}

- (NSString *)tableView:(UITableView *)tableView titleForFooterInSection:(NSInteger)section {
    
    if( viewResumeMode ){
        
        switch ( section ) {
            case 0: {
                
                int playersCount = [eventPlayerBuyinList count];
                
                if( playersCount==0 )
                    return NSLocalizedString(@"No player paid for buy-in", @"eventResultSave");
                
                NSString *plural = (playersCount==1?@"":NSLocalizedString(@"pluralPlayers", @"eventResultSave"));
                return [NSString stringWithFormat:@"%i %@%@, %@", playersCount, NSLocalizedString(@"player", @"eventResultSave"), plural, [numberFormatter stringFromNumber:[NSNumber numberWithFloat:event.totalBuyin]]];
                break;
            }
            case 1: {
                
                int playersCount = [eventPlayerRebuyList count];
                
                if( playersCount==0 )
                    return NSLocalizedString(@"No player paid for rebuy", @"eventResultSave");
                
                NSString *plural = (playersCount==1?@"":NSLocalizedString(@"pluralPlayers", @"eventResultSave"));
                return [NSString stringWithFormat:@"%i %@%@, %@", playersCount, NSLocalizedString(@"player", @"eventResultSave"), plural, [numberFormatter stringFromNumber:[NSNumber numberWithFloat:[event totalRebuy]]]];
                break;
            }
            case 2: {
                
                int playersCount = [eventPlayerAddonList count];
                
                if( playersCount==0 )
                    return NSLocalizedString(@"No player paid for add-on", @"eventResultSave");
                
                NSString *plural = (playersCount==1?@"":NSLocalizedString(@"pluralPlayers", @"eventResultSave"));
                return [NSString stringWithFormat:@"%i %@%@, %@", playersCount, NSLocalizedString(@"player", @"eventResultSave"), plural, [numberFormatter stringFromNumber:[NSNumber numberWithFloat:[event totalAddon]]]];
                break;
            }
        }
    }
    
    return [NSString stringWithFormat:@"%i %@. %@: %@", [eventPlayerList count], NSLocalizedString(@"players", @"eventResultSave"), NSLocalizedString(@"Total", @"eventResultSave"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:[event totalBuyins:YES]]]];
}

-(void)calculatePrize:(id)sender {
       
    [appDelegate checkNetworkStatus:kReachabilityChangedNotification];
    
    resultPreviewViewController.navigationItem.rightBarButtonItem = nil;
    resultPreviewViewController.navigationItem.rightBarButtonItem = activityIndicatorButton;
    [activityIndicator setHidden:NO];
    [activityIndicator startAnimating];
    
    btnCalculatePrize.enabled = NO;
    
    NSString *urlString = [NSString stringWithFormat:@"http://%@/ios.php/event/getPaidPlaces/eventId/%i/buyins/%f", serverAddress, event.eventId, [event totalBuyins:event.isFreeroll]];

//    NSLog(@"urlString: %@", urlString);
    
    NSURL *url = [NSURL URLWithString:urlString];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
    [NSURLConnection connectionWithRequest:request delegate:self];
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {

}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
//    NSLog(@"result: %@", result);
    
    if( [result isEqualToString:@"savedResult"] ){
        
        [self concludeSaveResult];
    }else{
    
        SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
        NSDictionary *jsonObjects = [jsonParser objectWithString:result error:nil];
        
        int paidPlaces = [[jsonObjects objectForKey:@"paidPlaces"] intValue];
        
//        NSLog(@"paidPlaces: %i", paidPlaces);
        
        for(int i=0; i < [eventPlayerList count]; i++){
            
//            NSLog(@"i: %i", i);
            
            if( i < paidPlaces ){
                
                float playerPrize = [[jsonObjects objectForKey:[NSString stringWithFormat:@"%i", i+1]] floatValue];
                [[eventPlayerList objectAtIndex:i] setPrize:playerPrize];
            }else{
                
                [[eventPlayerList objectAtIndex:i] setPrize:0];
            }
        }
        
        [result release];
        [self concludeCalculatePrize];
    }
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
    NSLog(@"connectionDidFinishLoading");
}

- (void)updateCurrentTextField:(id)sender {

    theTextField = (UITextField*)sender;
    
    switch ( theTextField.tag ) {
        case 1:
            eventPlayer.buyin = [theTextField.text floatValue];
            break;
        case 2:
            eventPlayer.rebuy = [theTextField.text floatValue];
            break;
        case 3:
            eventPlayer.addon = [theTextField.text floatValue];
            break;
        case 4:
            eventPlayer.prize = [theTextField.text floatValue];
            break;
            
        default:
            break;
    }
}

-(void)segmentedControlTouchUp:(id)sender {
    
    int selectedOption = [(UISegmentedControl *)sender selectedSegmentIndex];
    
    viewResumeMode = (selectedOption==1);
    
    if( viewResumeMode ){
        
        if( eventPlayerBuyinList!=nil ){
            
            [eventPlayerBuyinList release];
            eventPlayerBuyinList = nil;
        }
        
        eventPlayerBuyinList = [[NSMutableArray alloc] init];
        
        for(EventPlayer *theEventPlayer in eventPlayerList)
            if( theEventPlayer.buyin > 0 )
                [eventPlayerBuyinList addObject:theEventPlayer];
        
        
        if( eventPlayerRebuyList!=nil ){
            
            [eventPlayerRebuyList release];
            eventPlayerRebuyList = nil;
        }
        
        eventPlayerRebuyList = [[NSMutableArray alloc] init];
        
        for(EventPlayer *theEventPlayer in eventPlayerList)
            if( theEventPlayer.rebuy > 0 )
                [eventPlayerRebuyList addObject:theEventPlayer];
        
        
        if( eventPlayerAddonList!=nil ){
            
            [eventPlayerAddonList release];
            eventPlayerAddonList = nil;
        }
        
        eventPlayerAddonList = [[NSMutableArray alloc] init];
        
        for(EventPlayer *theEventPlayer in eventPlayerList)
            if( theEventPlayer.addon > 0 )
                [eventPlayerAddonList addObject:theEventPlayer];
    }
    
    [resultTableView reloadData];
}

- (UIViewController *)resultPreviewViewController {
    
    return resultPreviewViewController;
}

-(void)dealloc {
    
    [theTextField release];
//    [resultTableView release];
    [event release];
    [eventPlayer release];
    [eventPlayerList release];
    [numberFormatter release];
//    [resultPreviewViewController release];
    [super dealloc];
}

@end
